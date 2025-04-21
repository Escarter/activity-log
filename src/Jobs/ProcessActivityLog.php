<?php

namespace Escarter\ActivityLog\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Escarter\ActivityLog\DTOs\ActivityLogData;
use Escarter\ActivityLog\Actions\CreateActivityLogAction;

class ProcessActivityLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public int $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private ActivityLogData $activityLogData
    ) {}

    /**
     * Execute the job.
     */
    public function handle(CreateActivityLogAction $action): void
    {
        $action->execute($this->activityLogData);
    }
}
