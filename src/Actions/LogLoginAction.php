<?php

namespace Escarter\ActivityLog\Actions;

use Illuminate\Contracts\Auth\Authenticatable;
use Escarter\ActivityLog\DTOs\ActivityLogData;

class LogLoginAction
{
    public function __construct(
        private CreateActivityLogAction $createActivityLogAction
    ) {}

    public function execute(Authenticatable $user): void
    {
        $data = ActivityLogData::forLogin($user);

        $this->createActivityLogAction->execute($data);
    }
}
