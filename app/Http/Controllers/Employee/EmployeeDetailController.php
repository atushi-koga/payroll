<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Payroll\App\Service\EmployeeQueryService;
use Payroll\Domain\Model\Employee\EmployeeNumber;

class EmployeeDetailController extends Controller
{
    /** @var EmployeeQueryService */
    private $employeeQueryService;

    public function __construct(
        EmployeeQueryService $employeeQueryService
    ) {
        $this->employeeQueryService = $employeeQueryService;
    }

    public function detail($employeeNumber)
    {
        $employee = $this->employeeQueryService->choose(EmployeeNumber::of($employeeNumber));

        return view('employee.detail.detail', compact('employee'));
    }
}
