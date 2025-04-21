<?php

namespace Escarter\ActivityLog\Repositories;

use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Escarter\ActivityLog\Contracts\ActivityRepositoryInterface;
use Escarter\ActivityLog\DTOs\ActivityLogData;
use Escarter\ActivityLog\Models\ActivityLog;

class ActivityLogRepository implements ActivityRepositoryInterface
{
    public function create(ActivityLogData $data): ActivityLog
    {
        $attributes = [
            'log_name' => $data->logName,
            'description' => $data->description,
            'event' => $data->event,
            'properties' => $data->properties,
            'batch_uuid' => $data->batchUuid ?? null,
        ];

        if ($data->subject) {
            $attributes['subject_type'] = get_class($data->subject);
            $attributes['subject_id'] = $data->subject->getKey();
        }

        if ($data->causer) {
            $attributes['causer_type'] = get_class($data->causer);
            $attributes['causer_id'] = $data->causer->getKey();
        }

        return ActivityLog::create($attributes);
    }

    public function forSubject(Model $subject, array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = ActivityLog::forSubject($subject);

        return $this->applyFilters($query, $filters)->latest()->paginate($perPage);
    }

    public function byCauser(Model $causer, array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = ActivityLog::causedBy($causer);

        return $this->applyFilters($query, $filters)->latest()->paginate($perPage);
    }

    public function getAll(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = ActivityLog::query();

        return $this->applyFilters($query, $filters)->latest()->paginate($perPage);
    }

    public function applyFilters(Builder $query, array $filters = []): Builder
    {
        if (!empty($filters['log_name'])) {
            $query->where('log_name', $filters['log_name']);
        }

        if (!empty($filters['event'])) {
            $query->where('event', $filters['event']);
        }

        if (!empty($filters['causer_id']) && !empty($filters['causer_type'])) {
            $query->where('causer_type', $filters['causer_type'])
                ->where('causer_id', $filters['causer_id']);
        }

        if (!empty($filters['subject_id']) && !empty($filters['subject_type'])) {
            $query->where('subject_type', $filters['subject_type'])
                ->where('subject_id', $filters['subject_id']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        return $query;
    }

    public function deleteOlderThan(int $days): int
    {
        $cutoffDate = Carbon::now()->subDays($days);

        return ActivityLog::where('created_at', '<', $cutoffDate)->delete();
    }
}
