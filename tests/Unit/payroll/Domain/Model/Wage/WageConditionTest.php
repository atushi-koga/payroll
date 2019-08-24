<?php

namespace Tests\Unit\payroll\Domain\Model\Wage;

use Payroll\Domain\Model\Legislation\MidnightExtraRate;
use Payroll\Domain\Model\Legislation\OverTimeExtraRate;
use Payroll\Domain\Model\Wage\HourlyWage;
use Payroll\Domain\Model\Wage\WageCondition;
use Payroll\Domain\Type\Money\Money;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WageConditionTest extends TestCase
{
    public function testOf()
    {
        $hourlyWage = HourlyWage::of(Money::of(1000));
        $overTimeExtraRate = OverTimeExtraRate::of(30);
        $midnightExtraRate = MidnightExtraRate::of(30);

        $expected = new WageCondition($hourlyWage, $overTimeExtraRate, $midnightExtraRate);
        $actual = WageCondition::of($hourlyWage, $overTimeExtraRate, $midnightExtraRate);

        $this->assertTrue($expected == $actual);
    }

    public function testOfLegalRate()
    {
        $hourlyWage = HourlyWage::of(Money::of(1000));
        $overTimeExtraRate = OverTimeExtraRate::of(OverTimeExtraRate::REGAL_RATE);
        $midnightExtraRate = MidnightExtraRate::of(MidnightExtraRate::REGAL_RATE);

        $expected = new WageCondition($hourlyWage, $overTimeExtraRate, $midnightExtraRate);
        $actual = WageCondition::ofLegalRate($hourlyWage);

        $this->assertTrue($expected == $actual);
    }

    public function testBaseHourlyWage()
    {
        $hourlyWage = HourlyWage::of(Money::of(1000));
        $wageCondition = WageCondition::ofLegalRate($hourlyWage);

        $this->assertTrue($wageCondition->baseHourlyWage() == $hourlyWage);
    }

    public function testOverTimeExtraRate()
    {
        $hourlyWage = HourlyWage::of(Money::of(1000));
        $overTimeExtraRate = OverTimeExtraRate::of(OverTimeExtraRate::REGAL_RATE);
        $midnightExtraRate = MidnightExtraRate::of(MidnightExtraRate::REGAL_RATE);
        $wageCondition = new WageCondition($hourlyWage, $overTimeExtraRate, $midnightExtraRate);

        $this->assertTrue($wageCondition->overTimeExtraRate() == $overTimeExtraRate);
    }

    public function testMidnightExtraRate()
    {
        $hourlyWage = HourlyWage::of(Money::of(1000));
        $overTimeExtraRate = OverTimeExtraRate::of(OverTimeExtraRate::REGAL_RATE);
        $midnightExtraRate = MidnightExtraRate::of(MidnightExtraRate::REGAL_RATE);
        $wageCondition = new WageCondition($hourlyWage, $overTimeExtraRate, $midnightExtraRate);

        $this->assertTrue($wageCondition->midnightExtraRate() == $midnightExtraRate);
    }
}
