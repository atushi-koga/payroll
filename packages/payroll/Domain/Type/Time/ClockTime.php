<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Time;

class ClockTime
{
    /**
     * @var string
     */
    private $value;

    public function __construct(string $value)
    {
        self::validate($value);
        $this->value = $value;
    }

    public static function of(Hour $hour, Minute $minute): self
    {
        $minuteFormat = sprintf('%02d', $minute->value());
        return new self("{$hour->value()}:{$minuteFormat}");
    }

    public static function validate(string $value): void
    {
        if (preg_match('/\d{1,2}:\d{2}/', $value) !== 1) {
            throw new \InvalidArgumentException("hh:mmの形式を指定してください。 値:{$value}");
        }
    }
}
