<?php

namespace Traewelling\QueueMonitor\Tests\Support;

use Traewelling\QueueMonitor\Traits\IsMonitored;

class MonitoredJob extends BaseJob
{
    use IsMonitored;
}
