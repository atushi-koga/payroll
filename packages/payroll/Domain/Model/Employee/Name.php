<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Employee;

use InvalidArgumentException;

class Name
{
    const MAX_LENGTH = 40;

    /** @var string */
    private $value;

    /**
     * Name constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        if (self::validateNullOrEmptyString($value)) {
            throw new InvalidArgumentException('入力してください' . var_export($value, true));
        }
        if (self::validateGreaterThanMaxLength($value)) {
            throw new InvalidArgumentException(self::MAX_LENGTH . '文字以内で入力してください' . var_export($value, true));
        }

        $this->value = strval($value);
    }

    public static function of($value): self
    {
        return new self($value);
    }

    public static function validateNullOrEmptyString($value): bool
    {
        return $value === '' || is_null($value);
    }

    public static function validateGreaterThanMaxLength($value): bool
    {
        return mb_strlen($value) > 40;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
