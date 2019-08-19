<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Wage;

use Payroll\Domain\Type\Money\Money;

class HourlyWage
{
    /** @var Money */
    private $value;

    const BASE_HOURLY_WAGE = 985;

    public function __construct(Money $value)
    {
        $this->value = $value;
    }

    public static function of(Money $value): self
    {
        return new self($value);
    }

    public function value(): Money
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return strval($this->value);
    }
}
