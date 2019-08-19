<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Legislation;

class OverTimeExtraRate
{
    /** @var ExtraPayRate */
    private $value;

    const REGAL_RATE = 25;

    public function __construct(int $value)
    {
        $this->value = ExtraPayRate::of($value);
    }

    public static function of(int $value): self
    {
        return new self($value);
    }

    public static function ofLegalRate(): self
    {
        return new self(self::REGAL_RATE);
    }

    public function value(): ExtraPayRate
    {
        return $this->value;
    }

    public function asInt(): int
    {
        return $this->value
            ->value()
            ->value();
    }

    public function __toString(): string
    {
        return strval($this->value);
    }
}
