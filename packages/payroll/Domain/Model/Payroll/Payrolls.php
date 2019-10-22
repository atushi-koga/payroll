<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Payroll;

use Payroll\Domain\Model\Attendance\WorkMonth;

class Payrolls
{
    /**
     * @var WorkMonth
     */
    private $workMonth;
    /**
     * @var Payroll[]
     */
    private $list;

    public function __construct(WorkMonth $workMonth, array $payrolls)
    {
        $this->workMonth = $workMonth;
        $this->list = $payrolls;
    }

    public function list(): array
    {
        return $this->list;
    }
}
