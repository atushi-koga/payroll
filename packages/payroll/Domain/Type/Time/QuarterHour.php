<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Time;

/**
 * 15分単位の時間
 */
class QuarterHour
{
    /**
     * @var Minute
     */
    private $value;

    public function __construct(Minute $minute)
    {
        $this->value = $minute;
    }

    public function hour(): float
    {
        return round($this->value->floatValue() / 60, 2);
    }
}
