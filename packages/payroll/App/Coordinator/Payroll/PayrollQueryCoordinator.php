<?php
declare(strict_types=1);

namespace Payroll\App\Coordinator\Payroll;

use Payroll\App\Service\Attendance\AttendanceQueryService;
use Payroll\App\Service\Contract\ContractQueryService;
use Payroll\Domain\Model\Attendance\WorkMonth;
use Payroll\Domain\Model\Contract\Contract;
use Payroll\Domain\Model\Employee\ContractingEmployees;
use Payroll\Domain\Model\Employee\Employee;
use Payroll\Domain\Model\Payroll\Payroll;
use Payroll\Domain\Model\Payroll\Payrolls;

class PayrollQueryCoordinator
{
    /**
     * @var ContractQueryService
     */
    private $contractQueryService;
    /**
     * @var AttendanceQueryService
     */
    private $attendanceQueryService;

    public function __construct(
        ContractQueryService $contractQueryService,
        AttendanceQueryService $attendanceQueryService
    ) {
        $this->contractQueryService = $contractQueryService;
        $this->attendanceQueryService = $attendanceQueryService;
    }

    public function payrolls(
        ContractingEmployees $contractingEmployees,
        WorkMonth $workMonth
    ): Payrolls {
        $payrollArray = array_map(function (Employee $employee) use ($workMonth) {
            return $this->payroll($employee, $workMonth);
        }, $contractingEmployees->list());

        return new Payrolls($workMonth, $payrollArray);
    }

    public function payroll(Employee $employee, WorkMonth $workMonth): Payroll
    {
        $contractWages = $this->contractQueryService->getContractWages($employee->employeeNumber());
        $attendance = $this->attendanceQueryService->findAttendance(
            $employee->employeeNumber(),
            $workMonth
        );

        return new Payroll(
            new Contract($employee, $contractWages),
            $attendance
        );
    }
}
