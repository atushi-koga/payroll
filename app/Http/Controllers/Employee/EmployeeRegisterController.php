<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Payroll\App\Coordinator\EmployeeRecordCoordinator;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\Employee\MailAddress;
use Payroll\Domain\Model\Employee\Name;
use Payroll\Domain\Model\Employee\PhoneNumber;

class EmployeeRegisterController extends Controller
{
    /** @var EmployeeRecordCoordinator */
    private $employeeRecordCoordinator;

    public function __construct(EmployeeRecordCoordinator $employeeRecordCoordinator)
    {
        $this->employeeRecordCoordinator = $employeeRecordCoordinator;
    }

    public function showForm()
    {
        return view('employee.register.form');
    }

    public function confirm(Request $request)
    {
        // @todo: validationを記述

        $newEmployee = $this->makeNewEmployeeFromRequest($request);

        return view('employee.register.confirm', compact('newEmployee'));
    }

    public function registerThenRedirect(Request $request)
    {
        $newEmployee = $this->makeNewEmployeeFromRequest($request);
        /** @var EmployeeNumber $employeeNumber */
        $employeeNumber = DB::transaction(function () use ($newEmployee) {
            return $this->employeeRecordCoordinator->register($newEmployee->profile());
        });

        $name = $newEmployee->name();

        return redirect(route('employees-register#showComplete'))->with([
            'name'           => $name,
            'employeeNumber' => $employeeNumber,
        ]);
    }

    public function showComplete()
    {
        return view('employee.register.complete')->with([
            'name'           => session('name'),
            'employeeNumber' => session('employeeNumber')
        ]);
    }

    private function makeNewEmployeeFromRequest(Request $request): NewEmployee
    {
        return new NewEmployee(
            Name::of($request->input('name')),
            MailAddress::of($request->input('mail_address')),
            PhoneNumber::of($request->input('phone_number'))
        );
    }
}
