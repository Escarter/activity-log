<?php

namespace Escarter\ActivityLog\Actions;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Escarter\ActivityLog\Contracts\ActivityRepositoryInterface;
use Escarter\ActivityLog\DTOs\ActivityLogData;
use Escarter\ActivityLog\Events\ActivityLogged;
use Escarter\ActivityLog\Models\ActivityLog;

class CreateActivityLogAction implements ShouldQueue
{
    use Dispatchable;

    public function __construct(
        private ActivityRepositoryInterface $repository
    ) {}

    public function execute(ActivityLogData $data): ActivityLog
    {
        $log = $this->repository->create($data);

        ActivityLogged::dispatch($log);

        return $log;
    }
}
