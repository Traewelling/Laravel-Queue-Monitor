<?php

namespace Traewelling\QueueMonitor\Tests\Support;

use Traewelling\QueueMonitor\Traits\IsMonitored;

class MonitoredFailingJobWithHugeExceptionMessage extends BaseJob
{
    use IsMonitored;

    public function handle(): void
    {
        throw new IntentionallyFailedException(str_repeat('x', config('queue-monitor.db_max_length_exception_message') + 10));
    }
}
