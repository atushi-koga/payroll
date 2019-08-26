<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\TimeRecord;

use Payroll\Domain\Type\Time\ClockTime;
use Payroll\Domain\Type\Time\Hour;
use Payroll\Domain\Type\Time\Minute;

class EndTime
{
    /**
     * @var ClockTime
     */
    private $clockTime;

    public function __construct(ClockTime $clockTime)
    {
        $this->clockTime = $clockTime;
    }

    public static function ofByInt(int $hour, int $minute): self
    {
        return new self(
            ClockTime::of(
                new Hour($hour),
                new Minute($minute)
            )
        );
    }
}
