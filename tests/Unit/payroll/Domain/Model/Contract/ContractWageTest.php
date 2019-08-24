<?php

namespace Tests\Unit\payroll\Domain\Model\Contract;

use Payroll\Domain\Model\Contract\ContractStartingDate;
use Payroll\Domain\Model\Contract\ContractWage;
use Payroll\Domain\Model\Wage\HourlyWage;
use Payroll\Domain\Model\Wage\WageCondition;
use Payroll\Domain\Type\Date\Date;
use Payroll\Domain\Type\Money\Money;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractWageTest extends TestCase
{
    public function testOf()
    {
        $startDate = ContractStartingDate::ofByString('2019-08-25');
        $hourlyWage = HourlyWage::of(Money::of(1000));
        $wageCondition = WageCondition::ofLegalRate($hourlyWage);

        $expected = new ContractWage($startDate, $wageCondition);
        $actual = ContractWage::of($startDate, $wageCondition);

        $this->assertTrue($expected == $actual);
    }

    /**
     * @param $todayString
     * @param $expected
     * @dataProvider dataAvailableAt
     */
    public function testAvailableAt($todayString, $expected)
    {
        $startDate = ContractStartingDate::ofByString('2019-08-25');
        $hourlyWage = HourlyWage::of(Money::of(1000));
        $wageCondition = WageCondition::ofLegalRate($hourlyWage);
        $contractWage = ContractWage::of($startDate, $wageCondition);

        $this->assertTrue($contractWage->availableAt(Date::ofByString($todayString)) === $expected);
    }

    public function dataAvailableAt()
    {
        return [
            ['2019-08-26', true],
            ['2019-08-25', true],
            ['2019-08-24', false],
        ];
    }

    public function testStartDate()
    {
        $startDate = ContractStartingDate::ofByString('2019-08-25');
        $hourlyWage = HourlyWage::of(Money::of(1000));
        $wageCondition = WageCondition::ofLegalRate($hourlyWage);
        $contractWage = ContractWage::of($startDate, $wageCondition);

        $this->assertTrue($startDate == $contractWage->startDate());
    }

    public function testWageCondition()
    {
        $startDate = ContractStartingDate::ofByString('2019-08-25');
        $hourlyWage = HourlyWage::of(Money::of(1000));
        $wageCondition = WageCondition::ofLegalRate($hourlyWage);
        $contractWage = ContractWage::of($startDate, $wageCondition);

        $this->assertTrue($wageCondition == $contractWage->wageCondition());
    }

    public function testHourlyWage()
    {
        $startDate = ContractStartingDate::ofByString('2019-08-25');
        $hourlyWage = HourlyWage::of(Money::of(1000));
        $wageCondition = WageCondition::ofLegalRate($hourlyWage);
        $contractWage = ContractWage::of($startDate, $wageCondition);

        $this->assertTrue($hourlyWage == $contractWage->hourlyWage());
    }
}
