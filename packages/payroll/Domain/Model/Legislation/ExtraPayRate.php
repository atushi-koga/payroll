<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Legislation;

use Payroll\Domain\Type\Money\Percentage;

class ExtraPayRate
{
    /** @var Percentage */
    private $value;

    public function __construct(int $value)
    {
        $this->value = Percentage::of($value);
    }

    public static function of(int $value): self
    {
        return new self($value);
    }

    public function value(): Percentage
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return strval($this->value);
    }
}
