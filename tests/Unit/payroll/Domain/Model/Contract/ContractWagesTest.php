<?php

namespace Tests\Unit\payroll\Domain\Model\Contract;

use Payroll\Domain\Model\Contract\ContractStartingDate;
use Payroll\Domain\Model\Contract\ContractWage;
use Payroll\Domain\Model\Contract\ContractWages;
use Payroll\Domain\Model\Wage\HourlyWage;
use Payroll\Domain\Model\Wage\WageCondition;
use Payroll\Domain\Type\Money\Money;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractWagesTest extends TestCase
{
    public function testList()
    {
        $startDate1 = ContractStartingDate::ofByString('2018-12-31');
        $hourlyWage1 = HourlyWage::of(Money::of(1000));
        $wageCondition1 = WageCondition::ofLegalRate($hourlyWage1);
        $contractWage1 = ContractWage::of($startDate1, $wageCondition1);

        $startDate2 = ContractStartingDate::ofByString('2019-02-10');
        $hourlyWage2 = HourlyWage::of(Money::of(1100));
        $wageCondition2 = WageCondition::ofLegalRate($hourlyWage2);
        $contractWage2 = ContractWage::of($startDate2, $wageCondition2);

        $startDate3 = ContractStartingDate::ofByString('2019-10-01');
        $hourlyWage3 = HourlyWage::of(Money::of(1200));
        $wageCondition3 = WageCondition::ofLegalRate($hourlyWage3);
        $contractWage3 = ContractWage::of($startDate3, $wageCondition3);

        $startDate4 = ContractStartingDate::ofByString('2020-03-01');
        $hourlyWage4 = HourlyWage::of(Money::of(1300));
        $wageCondition4 = WageCondition::ofLegalRate($hourlyWage4);
        $contractWage4 = ContractWage::of($startDate4, $wageCondition4);

        $contractWageList = ContractWages::of([
            $contractWage3,
            $contractWage4,
            $contractWage1,
            $contractWage2,
        ])
            ->list();

        $this->assertTrue($contractWageList[0] == $contractWage4);
        $this->assertTrue($contractWageList[1] == $contractWage3);
        $this->assertTrue($contractWageList[2] == $contractWage2);
        $this->assertTrue($contractWageList[3] == $contractWage1);
    }
}
