<?php

namespace Traewelling\QueueMonitor\Tests\Support;

use Traewelling\QueueMonitor\Traits\IsMonitored;

class MonitoredPartiallyKeptJob extends BaseJob
{
    use IsMonitored;

    public static function keepMonitorOnSuccess(): bool
    {
        return false;
    }
}
