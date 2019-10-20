<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Date;

class YearMonth
{
    /**
     * @var Year
     */
    private $year;
    /**
     * @var Month
     */
    private $month;

    public function __construct(Year $year, Month $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public static function of(int $year, int $month): self
    {
        return new self(new Year($year), Month::of($month));
    }

    public static function ofByString(string $value): self
    {
        if (!self::validateFormat($value)) {
            throw new \InvalidArgumentException("不正な文字列フォーマットです。値:{$value}");
        }

        $year = explode('-', $value)[0];
        $month = explode('-', $value)[1];

        return self::of(intval($year), intval($month));
    }

    public static function validateFormat(string $value): bool
    {
        return preg_match('/^\d{4}-\d{2}$/', $value);
    }
}
