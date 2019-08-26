<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\TimeRecord;

class ActualWorkTime
{
    /**
     * @var TimeRange
     */
    private $timeRange;
    /**
     * @var DayTimeBreakTime
     */
    private $dayTimeBreakTime;
    /**
     * @var MidnightBreakTime
     */
    private $midnightBreakTime;

    public function __construct(
        TimeRange $timeRange,
        DayTimeBreakTime $dayTimeBreakTime,
        MidnightBreakTime $midnightBreakTime
    ) {
        $this->timeRange = $timeRange;
        $this->dayTimeBreakTime = $dayTimeBreakTime;
        $this->midnightBreakTime = $midnightBreakTime;
    }
}
