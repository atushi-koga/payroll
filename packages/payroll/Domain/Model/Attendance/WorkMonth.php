<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Attendance;

use Payroll\Domain\Type\Date\YearMonth;

class WorkMonth
{
    /**
     * @var YearMonth
     */
    private $yearMonth;

    public function __construct(YearMonth $yearMonth)
    {
        $this->yearMonth = $yearMonth;
    }

    public static function ofByString(string $value): self
    {
        return new self(YearMonth::ofByString($value));
    }
}
