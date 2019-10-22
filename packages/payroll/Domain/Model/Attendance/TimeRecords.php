<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Attendance;

use Payroll\Domain\Model\TimeRecord\TimeRecord;

class TimeRecords
{
    /**
     * @var TimeRecord[]
     */
    private $list;

    public function __construct(array $timeRecords)
    {
        $this->list = $timeRecords;
    }

    public function list(): array
    {
        return $this->list;
    }
}
