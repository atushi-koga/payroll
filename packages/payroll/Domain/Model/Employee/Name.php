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
        if (self::validateLessThanEqualMaxLength($value)) {
            throw new InvalidArgumentException(self::MAX_LENGTH . '文字以内で入力してください' . var_export($value, true));
        }

        $this->value = strval($value);
    }

    public static function validateNullOrEmptyString($value): bool
    {
        return $value === '' || is_null($value);
    }

    public static function validateLessThanEqualMaxLength($value): bool
    {
        return mb_strlen($value) <= 40;
    }

    public function value(): string
    {
        return $this->value;
    }

}
