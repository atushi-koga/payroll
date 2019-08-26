<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\TimeRecord;

use Payroll\Domain\Type\Time\Minute;

/*
 * 日中休憩時間
 */

class DayTimeBreakTime
{
    /**
     * @var Minute
     */
    private $minute;

    public function __construct(Minute $minute)
    {
        $this->minute = $minute;
    }

    public static function ofByInt(int $minute): self
    {
        return new self(
            new Minute($minute)
        );
    }
}
