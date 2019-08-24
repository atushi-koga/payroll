<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Contract;

use Payroll\Domain\Model\Wage\HourlyWage;
use Payroll\Domain\Model\Wage\WageCondition;
use Payroll\Domain\Type\Date\Date;

/**
 * 契約給与
 */
class ContractWage
{
    /** @var ContractStartingDate */
    private $startDate;

    /** @var WageCondition */
    private $wageCondition;

    public function __construct(ContractStartingDate $startDate, WageCondition $wageCondition)
    {
        $this->startDate = $startDate;
        $this->wageCondition = $wageCondition;
    }

    public static function of(ContractStartingDate $startDate, WageCondition $wageCondition): self
    {
        return new self($startDate, $wageCondition);
    }

    public function startDate(): ContractStartingDate
    {
        return $this->startDate;
    }

    public function wageCondition(): WageCondition
    {
        return $this->wageCondition;
    }

    public function hourlyWage(): HourlyWage
    {
        return $this->wageCondition->baseHourlyWage();
    }

    public function availableAt(Date $date): bool
    {
        return $this->startDate->isBeforeOrEqual($date);
    }

}
