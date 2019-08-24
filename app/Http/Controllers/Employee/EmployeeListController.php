<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Payroll\App\Service\Contract\ContractQueryService;
use Payroll\App\Service\EmployeeQueryService;
use Payroll\Domain\Model\Employee\ContractingEmployees;

class EmployeeListController extends Controller
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
     * 従業員の一覧表示
     */
    public function list()
    {
        $contractingEmployees = $this->employeeQueryService->contractingEmployees();
        $contracts = $this->contractQueryService->findContracts($contractingEmployees);
dd(
    $contractingEmployees,
    $contracts
);
        return view('employee.list', compact('contracts'));
    }
}
