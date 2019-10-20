<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Date;

class Year
{
    /**
     * @var int
     */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }
}
