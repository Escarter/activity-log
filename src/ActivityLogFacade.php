<?php

namespace Escarter\ActivityLog;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use Escarter\ActivityLog\Contracts\ActivityLoggerInterface;
use Escarter\ActivityLog\DTOs\ActivityLogData;
use Escarter\ActivityLog\Models\ActivityLog;

/**
 * @method static ActivityLog log(ActivityLogData $data)
 * @method static void logLogin(Authenticatable $user)
 * @method static void logModel(Model $model, string $event, ?Authenticatable $causer = null)
 * @method static int clean(int $days = 30)
 *
 * @see \Escarter\ActivityLog\Contracts\ActivityLoggerInterface
 */
class ActivityLogFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ActivityLoggerInterface::class;
    }
}
