<?php

namespace Escarter\ActivityLog\Contracts;

use Escarter\ActivityLog\DTOs\ActivityLogData;
use Escarter\ActivityLog\Models\ActivityLog;

interface ActivityLoggerInterface
{
    /**
     * Log an activity
     * 
     * @param ActivityLogData $data
     * @return ActivityLog
     */
    public function log(ActivityLogData $data): ActivityLog;

    /**
     * Clean old activity logs
     * 
     * @param int $days Number of days to keep logs
     * @return int Number of deleted records
     */
    public function clean(int $days = 30): int;

}
