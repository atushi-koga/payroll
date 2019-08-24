<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Wage;

use Payroll\Domain\Type\Money\Money;

/*
 * 時給
 */
class HourlyWage
{
    /** @var Money */
    private $value;

    const DISABLE_HOURLY_WAGE = 0;
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

    public static function disable(): self
    {
        return new self(Money::of(self::DISABLE_HOURLY_WAGE));
    }

    public function __toString(): string
    {
        if ($this->value->equal(Money::of(self::DISABLE_HOURLY_WAGE))) {
            return '';
        }

        return strval($this->value);
    }
}
