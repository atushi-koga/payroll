<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Date;


use DateTimeImmutable;

class DateTime
{
    /** @var DateTimeImmutable */
    private $value;

    /**
     * DateTime constructor.
     * @param DateTimeImmutable $value
     */
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

    public function toString(): string
    {
        return $this->value->format('Y-m-d H:i:s');
    }

    /**
     * @return DateTimeImmutable
     */
    public function value(): DateTimeImmutable
    {
        return $this->value;
    }
}
