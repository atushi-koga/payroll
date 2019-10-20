<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Date;

use Payroll\Domain\Type\Enum\EnumTrait;

class Month
{
    use EnumTrait;

    private const JANUARY = 1;
    private const FEBRUARY = 2;
    private const MARCH = 3;
    private const APRIL = 4;
    private const MAY = 5;
    private const JUNE = 6;
    private const JULY = 7;
    private const AUGUST = 8;
    private const SEPTEMBER = 9;
    private const OCTOBER = 10;
    private const NOVEMBER = 11;
    private const DECEMBER = 12;

    public static function of(int $value): self
    {
        return new self($value);
    }
}
