<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Amount;

class Amount
{
    /**
     * @var float
     */
    private $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function add(self $other): self
    {
        return new self($this->value + $other->value);
    }
}
