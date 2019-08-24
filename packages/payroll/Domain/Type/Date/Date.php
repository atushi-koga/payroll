<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Date;

use DateTimeImmutable;

class Date
{
    /** @var DateTimeImmutable */
    private $value;

    public function __construct(DateTimeImmutable $value)
    {
        $this->value = $value;
    }

    public static function of(DateTimeImmutable $value): self
    {
        return new self($value);
    }

    public static function ofByString(string $value): self
    {
        return new self(new DateTimeImmutable($value));
    }

    public static function now(): self
    {
        return new self(new DateTimeImmutable());
    }

    public static function distantFuture(): self
    {
        return new self(new DateTimeImmutable('9999-12-31'));
    }

    public function equal(Date $date): bool
    {
        return $this->value == $date->value();
    }

    public function isBeforeOrEqual(Date $date): bool
    {
        return $this->value <= $date->value();
    }

    public function isAfter(Date $date): bool
    {
        return $this->value > $date->value();
    }

    public function toString(): string
    {
        return $this->value->format('Y-m-d');
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @return DateTimeImmutable
     */
    public function value(): DateTimeImmutable
    {
        return $this->value;
    }
}
