<?php

namespace Traewelling\QueueMonitor\Controllers\Payloads;

final class Metrics
{
    /**
     * @var \Traewelling\QueueMonitor\Controllers\Payloads\Metric[]
     */
    public $metrics = [];

    /**
     * @return \Traewelling\QueueMonitor\Controllers\Payloads\Metric[]
     */
    public function all(): array
    {
        return $this->metrics;
    }

    public function push(Metric $metric): self
    {
        $this->metrics[] = $metric;

        return $this;
    }
}
