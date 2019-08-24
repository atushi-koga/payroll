<?php

namespace Tests\Unit\payroll\Domain\Model\Wage;

use Payroll\Domain\Model\Wage\HourlyWage;
use Payroll\Domain\Type\Money\Money;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HourlyWageTest extends TestCase
{
    public function testOf()
    {
        $money = Money::of(1000);
        $expected = new HourlyWage($money);

        $this->assertTrue($expected == HourlyWage::of($money));
    }

    public function testValue()
    {
        $money = Money::of(1000);
        $this->assertTrue($money == HourlyWage::of($money)->value());
    }

    public function testDisable()
    {
        $expected = HourlyWage::of(
            Money::of(HourlyWage::DISABLE_HOURLY_WAGE)
        );
        $this->assertTrue($expected == HourlyWage::disable());
    }

    /**
     * @param $moneyValue
     * @param $expected
     * @dataProvider dataToStringMagicMethod
     */
    public function testToStringMagicMethod($moneyValue, $expected)
    {
        $hourlyWage = HourlyWage::of(
            Money::of($moneyValue)
        );
        $this->assertTrue(htmlspecialchars($hourlyWage) === $expected);
    }

    public function dataToStringMagicMethod()
    {
        return [
            [HourlyWage::DISABLE_HOURLY_WAGE, ''],
            [1000, '1000']
        ];
    }
}
