<?php
declare(strict_types=1);

namespace Payroll\App\Coordinator\Payroll;

use Payroll\Domain\Model\Attendance\WorkMonth;
use Payroll\Domain\Model\Employee\ContractingEmployees;
use Payroll\Domain\Model\Payroll\Payrolls;

class PayrollQueryCoordinator
{
    public function payrolls(
        ContractingEmployees $contractingEmployees,
        WorkMonth $workMonth
    ): Payrolls {
    }
}
