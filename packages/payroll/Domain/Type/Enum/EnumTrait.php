<?php
declare(strict_types=1);

namespace Payroll\Domain\Type\Enum;

use BadMethodCallException;
use InvalidArgumentException;
use ReflectionObject;

trait EnumTrait
{
    private $scalar;

    private function __construct($value)
    {
        $ref = new ReflectionObject($this);
        $consts = $ref->getConstants();
        if (!in_array($value, $consts, true)) {
            throw new InvalidArgumentException("未定義の値です。(値='$value')");
        }

        $this->scalar = $value;
    }

    final public static function __callStatic($method, $args)
    {
        $class = get_called_class();
        $label = self::toLabel($method);
        $const = constant("$class::$label");
        return new $class($const);
    }

    private static function toLabel($str)
    {
        return ltrim(strtoupper(preg_replace('/[A-Z]+/', '_\0', $str)), '_');
    }

    final public function __toString()
    {
        return (string)$this->scalar;
    }

    final public function value()
    {
        return $this->scalar;
    }

    final public function __set($name, $value)
    {
        throw new BadMethodCallException('全てのセッターは禁止されています: ' .
            var_export([$name, $value], true));
    }
}
