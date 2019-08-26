<?php

namespace App\Http\Controllers\TimeRecord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Payroll\App\Service\EmployeeQueryService;
use Payroll\App\Service\TimeRecord\TimeRecordRecordService;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\TimeRecord\ActualWorkTime;
use Payroll\Domain\Model\TimeRecord\DayTimeBreakTime;
use Payroll\Domain\Model\TimeRecord\EndTime;
use Payroll\Domain\Model\TimeRecord\MidnightBreakTime;
use Payroll\Domain\Model\TimeRecord\StartTime;
use Payroll\Domain\Model\TimeRecord\TimeRange;
use Payroll\Domain\Model\TimeRecord\TimeRecord;
use Payroll\Domain\Model\TimeRecord\WorkDate;
use Payroll\Domain\Type\Date\Date;
use Payroll\Domain\Type\Time\Hour;
use Payroll\Domain\Type\Time\Minute;

class TimeRecordRegisterController extends Controller
{
    /** @var EmployeeQueryService */
    private $employeeQueryService;
    /**
     * @var TimeRecordRecordService
     */
    private $timeRecordRecordService;

    public function __construct(
        EmployeeQueryService $employeeQueryService,
        TimeRecordRecordService $timeRecordRecordService
    ) {
        $this->employeeQueryService = $employeeQueryService;
        $this->timeRecordRecordService = $timeRecordRecordService;
    }

    public function showForm()
    {
        $employees = $this->employeeQueryService->contractingEmployees();

        return view('timeRecord.form', compact('employees'));
    }

    public function registerThenRedirect(Request $request)
    {
        // @todo: validation

        $timeRange = new TimeRange(
            StartTime::ofByInt(
                intval($request->input('start_hour')),
                intval($request->input('start_minute'))
            ),
            EndTime::ofByInt(
                intval($request->input('end_hour')),
                intval($request->input('end_minute'))
            )
        );
        $actualWorkTime = new ActualWorkTime(
            $timeRange,
            DayTimeBreakTime::ofByInt(intval($request->input('daytime_break_time'))),
            MidnightBreakTime::ofByInt(intval($request->input('midnight_break_time')))
        );
        $employeeNumber = new EmployeeNumber($request->input('employee_no'));
        $workDate = new WorkDate(Date::ofByString($request->input('work_date')));

        $this->timeRecordRecordService->record(
            new TimeRecord($employeeNumber, $workDate, $actualWorkTime)
        );
    }
}
