<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Time;

/*
 * 分(数)
 */

class Minute
{
    /**
     * @var int
     */
    private $value;

    public function __construct(int $value)
    {
        self::validate($value);
        $this->value = $value;
    }

    public function validate(int $value): void
    {
        if ($value < 0) {
            throw new \InvalidArgumentException("正数を指定してください。 値: {$value}");
        }
    }

    public function value(): int
    {
        return $this->value;
    }

    public function floatValue(): float
    {
        return floatval($this->value);
    }
}
