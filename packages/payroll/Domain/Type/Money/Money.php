<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Money;

/*
 * 金額
 */
class Money
{
    /**
     * @var int
     */
    private $value;

    public static function of(int $value): self
    {
        return new self($value);
    }

    public function plus(Money $other): self
    {
        return new Money($this->value + $other->asInt());
    }

    public function minus(Money $other): self
    {
        return new Money($this->value - $other->asInt());
    }

    public function multiply(int $times): self
    {
        return new Money($this->value * $times);
    }

    public function isLess(Money $other): bool
    {
        return $this->value < $other->asInt();
    }

    public function isGreater(Money $other): bool
    {
        return $this->value > $other->asInt();
    }

    public function asInt(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return strval($this->value);
    }

    private function __construct(int $value)
    {
        $this->value = $value;
    }
}
