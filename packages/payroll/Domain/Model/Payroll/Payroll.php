<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Payroll;

use Payroll\Domain\Model\Attendance\Attendance;
use Payroll\Domain\Model\Contract\Contract;
use Payroll\Domain\Model\TimeRecord\TimeRecord;

class Payroll
{
    /**
     * @var Contract
     */
    private $contract;
    /**
     * @var Attendance
     */
    private $attendance;

    public function __construct(Contract $contract, Attendance $attendance)
    {
        $this->contract = $contract;
        $this->attendance = $attendance;
    }

    public function totalPayment(): PaymentAmount
    {
        return array_reduce(
            $this->attendance->timeRecords()->list(),
            function (PaymentAmount $carry, TimeRecord $item) {
                $contractWage = $this->contract->availableContractWageAt($item->date());
                $oneDayAmount = PaymentAmount::calculatedBy($item->actualWorkTime(), $contractWage->wageCondition());

                return $carry->add($oneDayAmount);
            },
            PaymentAmount::zero()
        );
    }
}
