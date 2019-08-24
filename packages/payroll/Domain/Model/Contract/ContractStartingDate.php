<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Contract;

use Payroll\Domain\Type\Date\Date;

/*
 * 契約開始日
 */

class ContractStartingDate
{
    /** @var Date */
    private $value;

    public function __construct(Date $value)
    {
        $this->value = $value;
    }

    public static function of(Date $value): self
    {
        return new self($value);
    }

    public static function ofByString(string $value): self
    {
        return new self(Date::ofByString($value));
    }

    public static function none(): self
    {
        return new self(Date::distantFuture());
    }

    public function __toString()
    {
        if ($this->notAvailable()) {
            return '未設定';
        }

        return $this->value->toString();
    }

    public function notAvailable(): bool
    {
        // @todo: equalメソッドを使う
        return $this->value == Date::distantFuture();
    }

    public function equal(Date $date): bool
    {
        return $this->value->equal($date);
    }

    public function isBeforeOrEqual(Date $date): bool
    {
        return $this->value->isBeforeOrEqual($date);
    }

    public function isAfter(Date $date): bool
    {
        return $this->value->isAfter($date);
    }

    public function value(): Date
    {
        return $this->value;
    }
}
