<?php

namespace App\Http\Controllers\Wage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Payroll\App\Service\Contract\ContractQueryService;
use Payroll\App\Service\EmployeeQueryService;
use Payroll\Domain\Model\Employee\EmployeeNumber;

class WageHistoryController extends Controller
{
    /** @var EmployeeQueryService */
    private $employeeQueryService;

    /** @var ContractQueryService */
    private $contractQueryService;

    public function __construct(
        EmployeeQueryService $employeeQueryService,
        ContractQueryService $contractQueryService
    ) {
        $this->employeeQueryService = $employeeQueryService;
        $this->contractQueryService = $contractQueryService;
    }

    /*
     * 従業員の時給の変遷を表示
     */
    public function history($employeeNumber)
    {
        $employee = $this->employeeQueryService->choose(EmployeeNumber::of($employeeNumber));
        $contractWages = $this->contractQueryService->getContractWages($employee->employeeNumber());

        return view('wage.history', compact('employee', 'contractWages'));
    }
}
