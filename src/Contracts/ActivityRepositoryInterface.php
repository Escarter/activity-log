<?php

namespace Escarter\ActivityLog\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Escarter\ActivityLog\DTOs\ActivityLogData;
use Escarter\ActivityLog\Models\ActivityLog;

interface ActivityRepositoryInterface
{
    /**
     * Create a new activity log entry
     * 
     * @param ActivityLogData $data
     * @return ActivityLog
     */
    public function create(ActivityLogData $data): ActivityLog;

    /**
     * Get activities for a specific subject
     * 
     * @param Model $subject
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function forSubject(Model $subject, array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Get activities for a specific causer
     * 
     * @param Model $causer
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function byCauser(Model $causer, array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Get activities for a specific log name
     * 
     * @param string $logName
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(
        array $filters = [],
        int $perPage = 15,
        string $sortField = 'created_at',
        string $sortDirection = 'desc'
    ): LengthAwarePaginator;

    /**
     * Apply filters to query
     * 
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    public function applyFilters(Builder $query, array $filters = []): Builder;

    /**
     * Delete logs older than specified days
     * 
     * @param int $days
     * @return int Number of deleted records
     */
    public function deleteOlderThan(int $days): int;

    /**
     * Delete multiple logs by ids
     * 
     * @param array $ids
     * @return bool
     */
    public function deleteMultiple(array $ids): bool;
}
