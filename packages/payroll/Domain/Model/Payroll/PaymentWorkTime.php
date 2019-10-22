<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Payroll;

use Payroll\Domain\Model\TimeRecord\WorkTime;
use Payroll\Domain\Model\Wage\HourlyWage;
use Payroll\Domain\Type\Time\QuarterHour;

/**
 * 支払い対象時間
 */
class PaymentWorkTime
{
    /**
     * @var QuarterHour
     */
    private $quarterHour;

    public function __construct(QuarterHour $quarterHour)
    {
        $this->quarterHour = $quarterHour;
    }

    public static function ofByWorkTime(WorkTime $workTime): self
    {
        return new self($workTime->quarterHour());
    }

    public function multiply(HourlyWage $hourlyWage): PaymentAmount
    {
        // todo: ロジックとして持ちたい
        return PaymentAmount::of(round($hourlyWage->value()->asInt() * $this->quarterHour->hour(), 4));
    }
}
