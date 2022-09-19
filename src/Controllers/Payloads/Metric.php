<?php

namespace Traewelling\QueueMonitor\Controllers\Payloads;

final class Metric
{
    /**
     * @var string
     */
    public $title;

    /**
     * @var float
     */
    public $value;

    /**
     * @var float
     */
    public $previousValue;

    /**
     * @var string
     */
    public $format;

    public function __construct(string $title, float $value = 0, float $previousValue = null, string $format = '%d')
    {
        $this->title = $title;
        $this->value = $value;
        $this->previousValue = $previousValue;
        $this->format = $format;
    }

    public function hasChanged(): bool
    {
        return $this->value !== $this->previousValue;
    }

    public function hasIncreased(): bool
    {
        return $this->value > $this->previousValue;
    }

    public function format(float $value): string
    {
        return sprintf($this->format, $value);
    }
}
