<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\TimeRecord;

use Payroll\Domain\Type\Date\Date;

class WorkDate
{
    /** @var Date */
    private $value;

    public function __construct(Date $value)
    {
        $this->value = $value;
    }

    public function value(): Date
    {
        return $this->value;
    }


}
