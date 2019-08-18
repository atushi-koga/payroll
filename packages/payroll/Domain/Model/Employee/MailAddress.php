<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Employee;

use InvalidArgumentException;

class MailAddress
{
    /** @var string */
    private $value;

    /**
     * MailAddress constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        if (self::validateNullOrEmptyString($value)) {
            throw new InvalidArgumentException('入力してください' . var_export($value, true));
        }
        if (self::validateInvalidMailAddressFormat($value)) {
            throw new InvalidArgumentException('メールアドレスが正しくありません' . var_export($value, true));
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

    public static function validateInvalidMailAddressFormat($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) === false;
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
