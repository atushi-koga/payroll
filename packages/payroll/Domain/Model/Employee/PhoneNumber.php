<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Employee;

use InvalidArgumentException;

class PhoneNumber
{
    /** @var string */
    private $value;

    const MIN_LENGTH = 8;
    const MAX_LENGTH = 13;

    /**
     * PhoneNumber constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        if (self::validateNullOrEmptyString($value)) {
            throw new InvalidArgumentException('入力してください' . var_export($value, true));
        }
        if (self::validateInvalidPhoneNumberFormat($value)) {
            throw new InvalidArgumentException('xx-xxxx-xxxxの形式で入力してください' . var_export($value, true));
        }
        if (self::validateInvalidLength($value)) {
            throw new InvalidArgumentException(self::MIN_LENGTH . '文字以上' . self::MAX_LENGTH . '文字以下で入力してください'
                . var_export($value, true));
        }

        $this->value = strval($value);
    }

    public static function validateNullOrEmptyString($value): bool
    {
        return $value === '' || is_null($value);
    }

    public static function validateInvalidPhoneNumberFormat($value): bool
    {
        return in_array(preg_match('/^¥d{2,4}-¥d{2,4}-¥d{2,4}$/', $value), [0, false], true);
    }

    public static function validateInvalidLength($value): bool
    {
        $numberCharLength = mb_strlen(str_replace('-', '', $value));

        return self::MIN_LENGTH <= $numberCharLength && $numberCharLength <= self::MAX_LENGTH;
    }
}
