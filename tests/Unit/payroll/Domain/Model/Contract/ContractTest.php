<?php

namespace Tests\Unit\payroll\Domain\Model\Contract;

use DateTimeImmutable;
use Exception;
use LogicException;
use Payroll\Domain\Model\Contract\Contract;
use Payroll\Domain\Model\Contract\ContractStartingDate;
use Payroll\Domain\Model\Contract\ContractStatus;
use Payroll\Domain\Model\Contract\ContractWage;
use Payroll\Domain\Model\Contract\ContractWages;
use Payroll\Domain\Model\Employee\Employee;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\Employee\MailAddress;
use Payroll\Domain\Model\Employee\Name;
use Payroll\Domain\Model\Employee\PhoneNumber;
use Payroll\Domain\Model\Wage\HourlyWage;
use Payroll\Domain\Model\Wage\WageCondition;
use Payroll\Domain\Type\Date\Date;
use Payroll\Domain\Type\Money\Money;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractTest extends TestCase
{
    /**
     * @param Contract $contract
     * @param ContractStartingDate $contractStartingDate
     * @dataProvider dataContractStartingDate
     */
    public function testContractStartingDate(Contract $contract, ContractStartingDate $contractStartingDate)
    {
        $this->assertTrue($contract->contractStartingDate() == $contractStartingDate);
    }

    public function dataContractStartingDate()
    {
        $employee = Employee::of(
            EmployeeNumber::of(1),
            Name::of('田中　一郎'),
            MailAddress::of('test@example.com'),
            PhoneNumber::of('090-1111-2222')
        );

        $startDate1 = ContractStartingDate::ofByString('2018-12-31');
        $hourlyWage1 = HourlyWage::of(Money::of(1000));
        $wageCondition1 = WageCondition::ofLegalRate($hourlyWage1);
        $contractWage1 = ContractWage::of($startDate1, $wageCondition1);

        $startDate2 = ContractStartingDate::ofByString('2019-02-10');
        $hourlyWage2 = HourlyWage::of(Money::of(1100));
        $wageCondition2 = WageCondition::ofLegalRate($hourlyWage2);
        $contractWage2 = ContractWage::of($startDate2, $wageCondition2);

        return [
            'empty ContractWages'       => [
                Contract::of($employee, ContractWages::of([])),
                ContractStartingDate::none(),
            ],
            'include one ContractWage'  => [
                Contract::of($employee, ContractWages::of([$contractWage1])),
                $startDate1,
            ],
            'include some ContractWage' => [
                Contract::of($employee, ContractWages::of([$contractWage1, $contractWage2])),
                $startDate1,
            ],
        ];
    }

    /**
     * @param Date $today
     * @param ContractStatus $contractStatus
     * @dataProvider dataContractStatus
     */
    public function testContractStatus(Date $today, ContractStatus $contractStatus)
    {
        $employee = Employee::of(
            EmployeeNumber::of(1),
            Name::of('田中　一郎'),
            MailAddress::of('test@example.com'),
            PhoneNumber::of('090-1111-2222')
        );

        $startDate = ContractStartingDate::ofByString('2018-12-31');
        $hourlyWage = HourlyWage::of(Money::of(1000));
        $wageCondition = WageCondition::ofLegalRate($hourlyWage);
        $contractWage = ContractWage::of($startDate, $wageCondition);

        $contract = Contract::of($employee, ContractWages::of([$contractWage]));

        $this->assertTrue($contract->contractStatus($today) == $contractStatus);
    }

    public function dataContractStatus()
    {
        return [
            'under contract' => [Date::ofByString('2019-01-01'), ContractStatus::underContract()],
            'no contract'    => [Date::ofByString('2018-12-30'), ContractStatus::noContract()],
        ];
    }

    /**
     * @param Contract $contract
     * @param Date $today
     * @param ContractWage $contractWage
     * @throws Exception
     * @dataProvider dataAvailableContractWageAt
     */
    public function testAvailableContractWageAt(Contract $contract, Date $today, ContractWage $contractWage)
    {
        $this->assertTrue(
            $contract->availableContractWageAt($today) == $contractWage
        );
    }

    public function dataAvailableContractWageAt()
    {
        $employee = Employee::of(
            EmployeeNumber::of(1),
            Name::of('田中　一郎'),
            MailAddress::of('test@example.com'),
            PhoneNumber::of('090-1111-2222')
        );

        $hourlyWage1 = HourlyWage::of(Money::of(1000));
        $wageCondition1 = WageCondition::ofLegalRate($hourlyWage1);
        $startDate1 = ContractStartingDate::ofByString('2018-12-01');
        $contractWage1 = ContractWage::of($startDate1, $wageCondition1);

        $hourlyWage2 = HourlyWage::of(Money::of(1100));
        $wageCondition2 = WageCondition::ofLegalRate($hourlyWage2);
        $startDate2 = ContractStartingDate::ofByString('2019-06-01');
        $contractWage2 = ContractWage::of($startDate2, $wageCondition2);

        return [
            'available contract1'    => [
                Contract::of($employee, ContractWages::of([$contractWage1])),
                Date::ofByString('2018-12-30'),
                $contractWage1
            ],
            'available contract2'    => [
                Contract::of($employee, ContractWages::of([$contractWage1, $contractWage2])),
                Date::ofByString('2018-12-30'),
                $contractWage1
            ],
            'new available contract' => [
                Contract::of($employee, ContractWages::of([$contractWage1, $contractWage2])),
                Date::ofByString('2019-06-30'),
                $contractWage2
            ],
        ];
    }

    /**
     * @param Contract $contract
     * @param Date $today
     * @expectedException LogicException
     * @dataProvider dataAvailableContractWageAtException
     */
    public function testAvailableContractWageAtException(Contract $contract, Date $today)
    {
        $contract->availableContractWageAt($today);
    }

    public function dataAvailableContractWageAtException()
    {
        $employee = Employee::of(
            EmployeeNumber::of(1),
            Name::of('田中　一郎'),
            MailAddress::of('test@example.com'),
            PhoneNumber::of('090-1111-2222')
        );

        $hourlyWage1 = HourlyWage::of(Money::of(1000));
        $wageCondition1 = WageCondition::ofLegalRate($hourlyWage1);
        $startDate1 = ContractStartingDate::ofByString('2018-12-01');
        $contractWage1 = ContractWage::of($startDate1, $wageCondition1);

        $hourlyWage2 = HourlyWage::of(Money::of(1100));
        $wageCondition2 = WageCondition::ofLegalRate($hourlyWage2);
        $startDate2 = ContractStartingDate::ofByString('2019-06-01');
        $contractWage2 = ContractWage::of($startDate2, $wageCondition2);

        return [
            'no available contract 1' => [
                Contract::of($employee, ContractWages::of([])),
                Date::ofByString('2018-10-01'),
            ],
            'no available contract 2' => [
                Contract::of($employee, ContractWages::of([$contractWage1])),
                Date::ofByString('2018-10-01'),
            ],
            'no available contract 3' => [
                Contract::of($employee, ContractWages::of([$contractWage1, $contractWage2])),
                Date::ofByString('2018-10-01'),
            ],
        ];
    }

    /**
     * @param Contract $contract
     * @param HourlyWage $hourlyWage
     * @throws Exception
     * @dataProvider dataTodayHourlyWage
     */
    public function testTodayHourlyWage(Contract $contract, HourlyWage $hourlyWage)
    {
        $this->assertTrue($contract->todayHourlyWage() == $hourlyWage);
    }

    public function dataTodayHourlyWage()
    {
        $employee = Employee::of(
            EmployeeNumber::of(1),
            Name::of('田中　一郎'),
            MailAddress::of('test@example.com'),
            PhoneNumber::of('090-1111-2222')
        );

        $hourlyWage1 = HourlyWage::of(Money::of(1000));
        $wageCondition1 = WageCondition::ofLegalRate($hourlyWage1);
        $startDate1 = ContractStartingDate::of(
            Date::of(new DateTimeImmutable('1 day 15:00'))
        );
        $contractWage1 = ContractWage::of($startDate1, $wageCondition1);

        $hourlyWage2 = HourlyWage::of(Money::of(1100));
        $wageCondition2 = WageCondition::ofLegalRate($hourlyWage2);
        $startDate2 = ContractStartingDate::of(
            Date::of(new DateTimeImmutable('2 day 15:00'))
        );
        $contractWage2 = ContractWage::of($startDate2, $wageCondition2);

        $hourlyWage3 = HourlyWage::of(Money::of(900));
        $wageCondition3 = WageCondition::ofLegalRate($hourlyWage3);
        $startDate3 = ContractStartingDate::of(
            Date::of(new DateTimeImmutable('-1 day 15:00'))
        );
        $contractWage3 = ContractWage::of($startDate3, $wageCondition3);

        $hourlyWage4 = HourlyWage::of(Money::of(800));
        $wageCondition4 = WageCondition::ofLegalRate($hourlyWage4);
        $startDate4 = ContractStartingDate::of(
            Date::of(new DateTimeImmutable('-2 day 15:00'))
        );
        $contractWage4 = ContractWage::of($startDate4, $wageCondition4);

        return [
            'no contract' => [
                Contract::of($employee, ContractWages::of([])),
                HourlyWage::disable(),
            ],
            'no available contract 1' => [
                Contract::of($employee, ContractWages::of([$contractWage1])),
                HourlyWage::disable(),
            ],
            'no available contract 2' => [
                Contract::of($employee, ContractWages::of([$contractWage1, $contractWage2])),
                HourlyWage::disable(),
            ],
            'available contract'    => [
                Contract::of($employee, ContractWages::of([$contractWage4])),
                $hourlyWage4,
            ],
            'new available contract 1'    => [
                Contract::of($employee, ContractWages::of([$contractWage4, $contractWage3])),
                $hourlyWage3,
            ],
            'new available contract 2'    => [
                Contract::of($employee, ContractWages::of([$contractWage4, $contractWage3, $contractWage1])),
                $hourlyWage3,
            ],
        ];
    }
}
