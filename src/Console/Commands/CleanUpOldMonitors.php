<?php

namespace Traewelling\QueueMonitor\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Traewelling\QueueMonitor\Services\QueueMonitor;

class CleanUpOldMonitors extends Command {

    protected $signature   = 'queue_monitoring:cleanup';
    protected $description = 'Delete old queue monitoring data';

    public function handle(): int {
        $timeFrame = config('queue-monitor.delete_old_items_after_days');

        QueueMonitor::getModel()->newQuery()
            ->where('started_at', '<=', Carbon::now()->subDays($timeFrame))
            ->delete();

        return 0;
    }
}
