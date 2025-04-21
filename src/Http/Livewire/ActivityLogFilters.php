<?php

namespace Escarter\ActivityLog\Commands;

use Illuminate\Console\Command;
use Escarter\ActivityLog\ActivityLogFacade as ActivityLog;

class CleanActivityLogs extends Command
{
    protected $signature = 'activity-log:clean {--days=30 : The number of days to keep activity logs}';

    protected $description = 'Clean old activity logs from the database';

    public function handle()
    {
        $days = (int) $this->option('days');

        $deletedRecords = ActivityLog::clean($days);

        $this->info("Successfully deleted {$deletedRecords} old activity log records.");

        return 0;
    }
}
