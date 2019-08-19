<?php
declare(strict_types=1);

namespace Payroll\App\Service\Contract;

use Payroll\Domain\Model\Contract\ContractRepositoryInterface;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\Wage\WageCondition;
use Payroll\Domain\Type\Date\Date;

class ContractRecordService
{
    /** @var ContractRepositoryInterface */
    private $contractRepo;

    public function __construct(ContractRepositoryInterface $contractRepo)
    {
        $this->contractRepo = $contractRepo;
    }

    public function registerHourlyWage(
        EmployeeNumber $employeeNumber,
        Date $startDate,
        WageCondition $wageCondition
    ): void {
        $this->contractRepo->registerHourlyWage($employeeNumber, $startDate, $wageCondition);
    }
}
