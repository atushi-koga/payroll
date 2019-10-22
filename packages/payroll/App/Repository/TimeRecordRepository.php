<?php
declare(strict_types=1);

namespace Payroll\App\Repository;

use Payroll\Domain\Model\Attendance\TimeRecords;
use Payroll\Domain\Model\Attendance\WorkMonth;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\TimeRecord\TimeRecord;

interface TimeRecordRepository
{
    public function registerTimeRecord(TimeRecord $timeRecord): void;

    public function findTimeRecords(EmployeeNumber $employeeNumber, WorkMonth $workMonth): TimeRecords;
}
