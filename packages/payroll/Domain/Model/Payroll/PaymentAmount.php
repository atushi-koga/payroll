<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Payroll;

use Payroll\Domain\Model\TimeRecord\ActualWorkTime;
use Payroll\Domain\Model\Wage\WageCondition;
use Payroll\Domain\Type\Amount\Amount;

class PaymentAmount
{
    /**
     * @var Amount
     */
    private $value;

    public function __construct(Amount $amount)
    {
        $this->value = $amount;
    }

    public static function of(float $value): self
    {
        return new self(new Amount($value));
    }

    public static function calculatedBy(ActualWorkTime $actualWorkTime, WageCondition $wageCondition): self
    {
//        PaymentAmount workTimeAmount = new PaymentWorkTime(actualWorkTime.workTime()).multiply(wageCondition.baseHourlyWage());
//        PaymentAmount overTimeExtraAmount = new PaymentWorkTime(actualWorkTime.overWorkTime()).multiply(wageCondition.overTimeHourlyExtraWage().value());
//        PaymentAmount midnightExtraAmount = new PaymentWorkTime(actualWorkTime.midnightWorkTime()).multiply(wageCondition.midnightHourlyExtraWage().value());
//        this.value = workTimeAmount.value.add(overTimeExtraAmount.value).add(midnightExtraAmount.value);

        $workTimeAmount = PaymentWorkTime::ofByWorkTime($actualWorkTime->workTime())->multiply($wageCondition->baseHourlyWage());

        return new self();
    }

    public static function zero(): self
    {
        return new self(new Amount(0.0));
    }

    public function add(self $other): self
    {
        return new self($this->value->add($other->value));
    }
}
