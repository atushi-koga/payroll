<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Payroll\Domain\Model\Employee\MailAddress;
use Payroll\Domain\Model\Employee\Name;
use Payroll\Domain\Model\Employee\PhoneNumber;

class EmployeeRegisterController extends Controller
{
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

        dd($newEmployee->profile());
    }

    public function showComplete()
    {

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
