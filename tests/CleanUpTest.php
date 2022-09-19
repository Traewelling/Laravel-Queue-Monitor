<?php

namespace Traewelling\QueueMonitor\Tests;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Traewelling\QueueMonitor\Console\Commands\CleanUpOldMonitors;
use Traewelling\QueueMonitor\Models\Monitor;
use Traewelling\QueueMonitor\Services\QueueMonitor;

class CleanUpTest extends TestCase {

    const CLEAN_UP_PERIOD = 7;
    public function setUp(): void {
        parent::setUp();
        Config::set("queue-monitor.delete_old_items_after_days", self::CLEAN_UP_PERIOD);
    }

    public function testItRemovesAnyOldJobMonitors() {
        $this->createMonitor("monitor_to_be_deleted", self::CLEAN_UP_PERIOD);

        (new CleanUpOldMonitors())->handle();

        $count_of_items = QueueMonitor::getModel()->newQuery()->count();
        $this->assertEquals(0, $count_of_items);
    }

    public function testItDoesNotRemoveYoungerMonitors() {
        $this->createMonitor("monitor_to_stay", 0);
        $this->createMonitor("monitor_to_be_deleted", self::CLEAN_UP_PERIOD);

        (new CleanUpOldMonitors())->handle();

        $count_of_items = QueueMonitor::getModel()->newQuery()->count();
        $this->assertEquals(1, $count_of_items);

        $still_there = QueueMonitor::getModel()
            ->newQuery()
            ->first();
        $this->assertInstanceOf(Monitor::class, $still_there);
        $this->assertEquals("monitor_to_stay", $still_there->name);
    }

    public function createMonitor($name, $age): void {
        $monitor = new Monitor();
        $monitor->name = $name;
        $monitor->started_at = Carbon::now()->subDays($age);
        $monitor->job_id = 42;
        $monitor->save();
    }
}
