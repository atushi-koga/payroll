<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\TimeRecord;

use Payroll\Domain\Model\Employee\EmployeeNumber;

class TimeRecord
{
    /** @var EmployeeNumber */
    private $employeeNumber;

    /** @var WorkDate */
    private $workDate;

    /** @var ActualWorkTime */
    private $ActualWorkTime;

    public function __construct(EmployeeNumber $employeeNumber, WorkDate $workDate, ActualWorkTime $ActualWorkTime)
    {
        $this->employeeNumber = $employeeNumber;
        $this->workDate = $workDate;
        $this->ActualWorkTime = $ActualWorkTime;
    }

    /**
     * @return EmployeeNumber
     */
    public function employeeNumber(): EmployeeNumber
    {
        return $this->employeeNumber;
    }

    /**
     * @return WorkDate
     */
    public function workDate(): WorkDate
    {
        return $this->workDate;
    }

    /**
     * @return ActualWorkTime
     */
    public function ActualWorkTime(): ActualWorkTime
    {
        return $this->ActualWorkTime;
    }


}
