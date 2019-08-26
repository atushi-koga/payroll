<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\TimeRecord;

class TimeRange
{
    /**
     * @var StartTime
     */
    private $startTime;
    /**
     * @var EndTime
     */
    private $endTime;

    public function __construct(StartTime $startTime, EndTime $endTime)
    {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }
}
