<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Money;

class Percentage
{
    /** @var int */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function of(int $value): self
    {
        return new self($value);
    }

    /*
     * 100で割った値を返す
     * @todo: BC Math関数を使う
     */
    public function rate()
    {

    }

    public function value(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return strval($this->value);
    }
}
