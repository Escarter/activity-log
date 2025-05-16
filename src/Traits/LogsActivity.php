<?php

namespace Escarter\ActivityLog\Traits;

use Illuminate\Database\Eloquent\Model;
use Escarter\ActivityLog\ActivityLogFacade as ActivityLog;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::created(function (Model $model) {
            $model->logActivityIfNeeded('created');
        });

        static::updated(function (Model $model) {
            $model->logActivityIfNeeded('updated');
        });

        static::deleted(function (Model $model) {
            $model->logActivityIfNeeded('deleted');
        });
    }

    protected function logActivityIfNeeded(string $event): void
    {
        if (!$this->shouldLogActivity($event)) {
            return;
        }

        $causer = $this->determineActivityCauser();
        ActivityLog::logModel($this, $event, $causer);
    }

    protected function shouldLogActivity(string $event): bool
    {
        // Allow model to override this method
        if (method_exists($this, 'customShouldLogActivity')) {
            return $this->customShouldLogActivity($event);
        }

        return true;
    }

    protected function determineActivityCauser()
    {
        // Allow model to specify causer
        if (method_exists($this, 'getActivityCauser')) {
            return $this->getActivityCauser();
        }

        return auth()->user();
    }

    public function activities()
    {
        return $this->morphMany(config('activity-log.activity_model'), 'subject');
    }
}
