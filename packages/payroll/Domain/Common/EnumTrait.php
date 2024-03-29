<?php
declare(strict_types=1);

namespace Payroll\Domain\Common;

use BadMethodCallException;
use InvalidArgumentException;

/*
 * 古いversion
 * Domain/Type/Enum配下のものを使う
 */
trait EnumTrait
{
    private $scalar;

    final public function __construct($value)
    {
        if (!self::isValidValue($value)) {
            throw new InvalidArgumentException(
                '不正な値です:' . var_export([self::ENUM, $value], true)
            );
        }

        $this->scalar = $value;
    }

    final public static function __callStatic(string $name, array $arguments)
    {
        if (!self::isValidName($name)) {
            throw new BadMethodCallException(
                '不正な名前です:' . var_export([self::ENUM, $name], true)
            );
        }

        return new self(self::ENUM[$name]);
    }

    final public static function isValidValue($value): bool
    {
        return in_array($value, self::ENUM, true);
    }

    final public static function isValidName($name): bool
    {
        return array_key_exists($name, self::ENUM);
    }

    final public function value()
    {
        return $this->scalar;
    }

    final public function __toString(): string
    {
        return strval($this->scalar);
    }

    final public function __set($name, $value)
    {
        throw new BadMethodCallException(
            '全てのセッターは禁止されています:' . var_export([$name, $value], true));
    }
}
