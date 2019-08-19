<?php

namespace App\Http\Controllers\Wage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Payroll\App\Service\Contract\ContractRecordService;
use Payroll\App\Service\EmployeeQueryService;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\Wage\HourlyWage;
use Payroll\Domain\Model\Wage\WageCondition;
use Payroll\Domain\Type\Date\Date;
use Payroll\Domain\Type\Date\DateTime;
use Payroll\Domain\Type\Money\Money;

class WageRegisterController extends Controller
{
    /** @var EmployeeQueryService */
    private $employeeQueryService;

    /** @var ContractRecordService */
    private $contractRecordService;

    public function __construct(
        EmployeeQueryService $employeeQueryService,
        ContractRecordService $contractRecordService
    ) {
        $this->employeeQueryService = $employeeQueryService;
        $this->contractRecordService = $contractRecordService;
    }

    public function showForm($employeeNumber)
    {
        $employee = $this->employeeQueryService->choose(EmployeeNumber::of($employeeNumber));
        $hourlyWage = HourlyWage::of(Money::of(HourlyWage::BASE_HOURLY_WAGE));

        return view('wage.form', compact('employee', 'hourlyWage'));
    }

    public function confirm(Request $request, $employeeNumber)
    {
        // @todo: validation

        $employee = $this->employeeQueryService->choose(EmployeeNumber::of($employeeNumber));

        $requestHourlyWage = intval($request->input('hourly_wage'));
        $hourlyWage = HourlyWage::of(Money::of($requestHourlyWage));

        $startDate = Date::ofByString($request->input('start_date'));

        return view('wage.confirm')->with([
            'employee'   => $employee,
            'hourlyWage' => $hourlyWage,
            'startDate'  => $startDate,
        ]);
    }

    public function registerThenRedirect(Request $request, $employeeNumber)
    {
        $requestHourlyWage = intval($request->input('hourly_wage'));
        $hourlyWage = HourlyWage::of(Money::of($requestHourlyWage));
        $wageCondition = WageCondition::ofLegalRate($hourlyWage);

        DB::transaction(function () use ($employeeNumber, $request, $wageCondition) {
            $this->contractRecordService->registerHourlyWage(
                EmployeeNumber::of(intval($employeeNumber)),
                Date::ofByString($request->start_date),
                $wageCondition
            );
        });

        return redirect(route('wages-register#showComplete', ['employeeNumber' => $employeeNumber]));
    }

    public function showComplete()
    {
        dd('complete');
    }
}
