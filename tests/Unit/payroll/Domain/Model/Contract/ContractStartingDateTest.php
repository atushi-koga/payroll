<?php

namespace Tests\Unit\payroll\Domain\Model\Contract;

use Payroll\Domain\Model\Contract\ContractStartingDate;
use Payroll\Domain\Type\Date\Date;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContractStartingDateTest extends TestCase
{
    public function testOf()
    {
        $date = Date::ofByString('2019-08-25');
        $this->assertTrue(new ContractStartingDate($date) == ContractStartingDate::of($date));
    }

    public function testOfByString()
    {
        $dateString = '2019-08-25';
        $date = Date::ofByString($dateString);
        $expected = new ContractStartingDate($date);

        $this->assertTrue($expected == ContractStartingDate::ofByString($dateString));
    }

    public function testNone()
    {
        $this->assertTrue(ContractStartingDate::none() == ContractStartingDate::of(Date::distantFuture()));
    }

    /**
     * @param $dateString
     * @param $expected
     * @dataProvider dataToStringMagicMethod
     */
    public function testToStringMagicMethod($dateString, $expected)
    {
        $contractStartingDate = ContractStartingDate::ofByString($dateString);
        $this->assertTrue(htmlspecialchars($contractStartingDate) === $expected);
    }

    public function dataToStringMagicMethod()
    {
        return [
            ['2019-08-25', '2019-08-25'],
            ['9999-12-31', '未設定'],
        ];
    }

    /**
     * @param $dateString
     * @param $expected
     * @dataProvider dataNotAvailable
     */
    public function testNotAvailable($dateString, $expected)
    {
        $contactStartingDate = ContractStartingDate::ofByString($dateString);
        $this->assertTrue($contactStartingDate->notAvailable() === $expected);
    }

    public function dataNotAvailable()
    {
        return [
            ['2019-08-25', false],
            ['9999-12-31', true],
        ];
    }

    /**
     * @param $dateString1
     * @param $dateString2
     * @param $expected
     * @dataProvider dataEqual
     */
    public function testEqual($dateString1, $dateString2, $expected)
    {
        $contractStartingDate = ContractStartingDate::ofByString($dateString1);
        $date = Date::ofByString($dateString2);

        $this->assertTrue($expected === $contractStartingDate->equal($date));
    }

    public function dataEqual()
    {
        return [
            ['2019-08-25', '2019-08-25', true],
            ['2019-08-25', '2019-08-26', false],
            ['2019-08-25', '2019-08-24', false],
        ];
    }

    /**
     * @param $dateString1
     * @param $dateString2
     * @param $expected
     * @dataProvider dataIsBeforeOrEqual
     */
    public function testIsBeforeOrEqual($dateString1, $dateString2, $expected)
    {
        $contractStartingDate = ContractStartingDate::ofByString($dateString1);
        $date = Date::ofByString($dateString2);

        $this->assertTrue($expected === $contractStartingDate->isBeforeOrEqual($date));
    }

    public function dataIsBeforeOrEqual()
    {
        return [
            ['2019-08-25', '2019-08-25', true],
            ['2019-08-25', '2019-08-26', true],
            ['2019-08-25', '2019-08-24', false],
        ];
    }

    /**
     * @param $dateString1
     * @param $dateString2
     * @param $expected
     * @dataProvider dataIsAfter
     */
    public function testIsAfter($dateString1, $dateString2, $expected)
    {
        $contractStartingDate = ContractStartingDate::ofByString($dateString1);
        $date = Date::ofByString($dateString2);

        $this->assertTrue($expected === $contractStartingDate->isAfter($date));
    }

    public function dataIsAfter()
    {
        return [
            ['2019-08-25', '2019-08-25', false],
            ['2019-08-25', '2019-08-26', false],
            ['2019-08-25', '2019-08-24', true],
        ];
    }
}
