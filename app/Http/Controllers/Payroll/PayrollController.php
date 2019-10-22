<?php

namespace App\Http\Controllers\Payroll;

use DateTimeImmutable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Payroll\App\Coordinator\Payroll\PayrollQueryCoordinator;
use Payroll\App\Service\EmployeeQueryService;
use Payroll\Domain\Model\Attendance\WorkMonth;

class PayrollController extends Controller
{
    /**
     * @var EmployeeQueryService
     */
    private $employeeQueryService;
    /**
     * @var PayrollQueryCoordinator
     */
    private $payrollQueryCoordinator;

    public function __construct(
        EmployeeQueryService $employeeQueryService,
        PayrollQueryCoordinator $payrollQueryCoordinator
    ) {
        $this->employeeQueryService = $employeeQueryService;
        $this->payrollQueryCoordinator = $payrollQueryCoordinator;
    }

    public function list(Request $request)
    {
        if ($request->input('work_month')) {
            $workMonth = WorkMonth::ofByString($request->input('work_month'));
        } else {
            $workMonth = WorkMonth::ofByString((new DateTimeImmutable())->format('Y-m'));
        }

        $contractingEmployees = $this->employeeQueryService->contractingEmployees();
        $payrolls = $this->payrollQueryCoordinator->payrolls($contractingEmployees, $workMonth);

        return view('payroll.list', compact('payrolls'));
    }
}
