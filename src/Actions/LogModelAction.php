<?php

namespace Escarter\ActivityLog\Actions;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Escarter\ActivityLog\DTOs\ActivityLogData;

class LogModelAction
{
    public function __construct(
        private CreateActivityLogAction $createActivityLogAction
    ) {}

    public function execute(Model $model, string $event, ?Authenticatable $causer = null): void
    {
        $data = ActivityLogData::forModel($model, $event, $causer);

        $this->createActivityLogAction->execute($data);
    }
}
