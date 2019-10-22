<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\TimeRecord;

use Payroll\Domain\Type\Time\QuarterHour;

class WorkTime
{
    /**
     * @var QuarterHour
     */
    private $value;
    /**
     * @var DaytimeWorkTime
     */
    private $daytimeWorkTime;
    /**
     * @var MidnightWorkTime
     */
    private $midnightWorkTime;

    public function __construct(DaytimeWorkTime $daytimeWorkTime, MidnightWorkTime $midnightWorkTime)
    {
        $this->daytimeWorkTime = $daytimeWorkTime;
        $this->midnightWorkTime = $midnightWorkTime;
    }

    public function quarterHour(): QuarterHour
    {
        return $this->value;
    }
}
