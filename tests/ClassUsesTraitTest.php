<?php

namespace Traewelling\QueueMonitor\Tests;

use Traewelling\QueueMonitor\Services\ClassUses;
use Traewelling\QueueMonitor\Tests\Support\MonitoredExtendingJob;
use Traewelling\QueueMonitor\Tests\Support\MonitoredJob;
use Traewelling\QueueMonitor\Traits\IsMonitored;

class ClassUsesTraitTest extends TestCase
{
    public function testUsingMonitorTrait()
    {
        $this->assertArrayHasKey(
            IsMonitored::class,
            ClassUses::classUsesRecursive(MonitoredJob::class)
        );
    }

    public function testUsingMonitorTraitExtended()
    {
        $this->assertArrayHasKey(
            IsMonitored::class,
            ClassUses::classUsesRecursive(MonitoredExtendingJob::class)
        );
    }
}
