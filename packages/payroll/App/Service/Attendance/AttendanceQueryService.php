<?php
declare(strict_types=1);

namespace Payroll\App\Service\Attendance;

use Payroll\App\Repository\TimeRecordRepository;
use Payroll\Domain\Model\Attendance\Attendance;
use Payroll\Domain\Model\Attendance\WorkMonth;
use Payroll\Domain\Model\Employee\EmployeeNumber;

class AttendanceQueryService
{
    /**
     * @var TimeRecordRepository
     */
    private $timeRecordRepository;

    public function __construct(
        TimeRecordRepository $timeRecordRepository
    ) {
        $this->timeRecordRepository = $timeRecordRepository;
    }

    public function findAttendance(EmployeeNumber $employeeNumber, WorkMonth $workMonth): Attendance
    {
        return new Attendance(
            $employeeNumber,
            $workMonth,
            $this->timeRecordRepository->findTimeRecords($employeeNumber, $workMonth)
        );
    }
}
