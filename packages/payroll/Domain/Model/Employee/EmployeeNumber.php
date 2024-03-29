<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Employee;

class EmployeeNumber
{
    /** @var int */
    private $value;

    /**
     * EmployeeNumber constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function of(int $value): self
    {
        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return strval($this->value());
    }
}
