<?php

namespace Escarter\ActivityLog\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Escarter\ActivityLog\Models\ActivityLog;

class ActivityLogged
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public ActivityLog $activityLog
    ) {}
}
