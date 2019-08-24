<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Contract;

use Exception;
use LogicException;
use Payroll\Domain\Model\Employee\Employee;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\Employee\Name;
use Payroll\Domain\Model\Wage\HourlyWage;
use Payroll\Domain\Type\Date\Date;

class Contract
{
    /** @var Employee */
    private $employee;

    /** @var ContractWages */
    private $contractWages;

    public function __construct(Employee $employee, ContractWages $contractWages)
    {
        $this->employee = $employee;
        $this->contractWages = $contractWages;
    }

    public static function of(Employee $employee, ContractWages $contractWages): self
    {
        return new self($employee, $contractWages);
    }

    public function employeeNumber(): EmployeeNumber
    {
        return $this->employee->employeeNumber();
    }

    public function employeeName(): Name
    {
        return $this->employee->name();
    }

    /**
     * @return HourlyWage
     * @throws Exception
     */
    public function todayHourlyWage(): HourlyWage
    {
        $today = Date::now();
        if ($this->contractStatus($today)->isDisable()) {
            return HourlyWage::disable();
        }

        return $this->availableContractWageAt($today)->hourlyWage();
    }

    /**
     * 現在適用されている契約給与を返す
     *
     * @param Date $date
     * @return ContractWage
     * @throws LogicException
     */
    public function availableContractWageAt(Date $date): ContractWage
    {
        $availableContractWages = array_filter(
            $this->contractWages->list(),
            function (/** @var ContractWage $contractWage */ $contractWage) use ($date) {
                return $contractWage->availableAt($date);
            });

        if (count($availableContractWages) === 0) {
            throw new LogicException('契約がありません:' . var_export([$date, $this->contractWages->list()], true));
        }

        return array_shift($availableContractWages);
    }

    public function contractStatus(Date $date): ContractStatus
    {
        return $this->contractStartingDate()->isAfter($date) ? ContractStatus::noContract() : ContractStatus::underContract();
    }

    /*
     * 契約開始日を取得
     */
    public function contractStartingDate(): ContractStartingDate
    {
        $contractWageList = $this->contractWages->list();
        $contractWageCount = count($contractWageList);
        if ($contractWageCount === 0) {
            return ContractStartingDate::none();
        }

        return $contractWageList[$contractWageCount - 1]->startDate();
    }

}
