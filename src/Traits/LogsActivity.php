<?php

namespace Escarter\ActivityLog\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Escarter\ActivityLog\Actions\LogModelAction;
use Escarter\ActivityLog\ActivityLogFacade as ActivityLog;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::created(function (Model $model) {
            if (static::shouldLogActivity($model, 'created')) {
                ActivityLog::logModel($model, 'created', Auth::user());
            }
        });

        static::updated(function (Model $model) {
            if (static::shouldLogActivity($model, 'updated')) {
                ActivityLog::logModel($model, 'updated', Auth::user());
            }
        });

        static::deleted(function (Model $model) {
            if (static::shouldLogActivity($model, 'deleted')) {
                ActivityLog::logModel($model, 'deleted', Auth::user());
            }
        });
    }

    protected static function shouldLogActivity(Model $model, string $event): bool
    {
        if (method_exists($model, 'shouldLogActivity')) {
            return $model->shouldLogActivity($event);
        }

        return true;
    }

    public function activities()
    {
        return $this->morphMany(config('activity-log.activity_model'), 'subject');
    }
}
