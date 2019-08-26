<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Time;

/*
 * 時間(数)
 */
class Hour
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

    public function toMinutes(): Minute
    {
        return new Minute($this->value * 60);
    }
}
