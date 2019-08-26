<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Contract;

use Payroll\Domain\Model\Employee\ContractingEmployees;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\Wage\WageCondition;
use Payroll\Domain\Type\Date\Date;

interface ContractRepositoryInterface
{
    public function registerHourlyWage(EmployeeNumber $employeeNumber, Date $startDate, WageCondition $wageCondition);

    public function findContracts(ContractingEmployees $contractingEmployees);

    public function getContractWages(EmployeeNumber $employeeNumber);
}
