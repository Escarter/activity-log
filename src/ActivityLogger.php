<?php

namespace Escarter\ActivityLog;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Escarter\ActivityLog\Actions\LogLoginAction;
use Escarter\ActivityLog\Actions\LogModelAction;
use Escarter\ActivityLog\Contracts\ActivityLoggerInterface;
use Escarter\ActivityLog\Contracts\ActivityRepositoryInterface;
use Escarter\ActivityLog\DTOs\ActivityLogData;
use Escarter\ActivityLog\Models\ActivityLog;

class ActivityLogger implements ActivityLoggerInterface
{
    public function __construct(
        private ActivityRepositoryInterface $repository
    ) {}

    public function log(ActivityLogData $data): ActivityLog
    {
        return app(CreateActivityLogAction::class)->execute($data);
    }

    public function logLogin(Authenticatable $user): void
    {
        app(LogLoginAction::class)->execute($user);
    }

    public function logModel(Model $model, string $event, ?Authenticatable $causer = null): void
    {
        app(LogModelAction::class)->execute($model, $event, $causer);
    }

    public function clean(int $days = 30): int
    {
        return $this->repository->deleteOlderThan($days);
    }
}
