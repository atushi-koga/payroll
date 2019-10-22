<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Attendance;

use Payroll\Domain\Model\Employee\EmployeeNumber;

class Attendance
{
    /**
     * @var EmployeeNumber
     */
    private $employeeNumber;
    /**
     * @var WorkMonth
     */
    private $workMonth;
    /**
     * @var TimeRecords
     */
    private $timeRecords;

    public function __construct(EmployeeNumber $employeeNumber, WorkMonth $workMonth, TimeRecords $timeRecords)
    {
        $this->employeeNumber = $employeeNumber;
        $this->workMonth = $workMonth;
        $this->timeRecords = $timeRecords;
    }

    public function timeRecords(): TimeRecords
    {
        return $this->timeRecords;
    }
}
