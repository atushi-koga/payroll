<?php

namespace Tests\Unit\payroll\Domain\Type\Date;

use DateTimeImmutable;
use Exception;
use Payroll\Domain\Type\Date\Date;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DateTest extends TestCase
{
    /**
     * @param $dateString
     * @dataProvider dataDateString
     * @throws Exception
     */
    public function testOfByString($dateString)
    {
        $dateTimeImmutable = new DateTimeImmutable($dateString);
        $date = new Date($dateTimeImmutable);

        $this->assertTrue($date == Date::ofByString($dateString));
    }

    /**
     * @param $dateString
     * @dataProvider dataDateString
     * @throws Exception
     */
    public function testOf($dateString)
    {
        $dateTimeImmutable = new DateTimeImmutable($dateString);
        $date = new Date($dateTimeImmutable);

        $this->assertTrue($date == Date::of($dateTimeImmutable));
    }

    public function dataDateString()
    {
        return [
            ['2018-12-31'],
            ['2019-01-01'],
            ['2019-1-1'],
            ['2019-1-10'],
        ];
    }

    public function testDistantFuture()
    {
        $dateTimeImmutable = new DateTimeImmutable('9999-12-31');
        $date = new Date($dateTimeImmutable);

        $this->assertTrue($date == Date::distantFuture());
    }

    /**
     * @param $dateString1
     * @param $dateString2
     * @param $expected
     * @dataProvider dataEqual
     */
    public function testEqual($dateString1, $dateString2, $expected)
    {
        $date1 = Date::ofByString($dateString1);
        $date2 = Date::ofByString($dateString2);

        $this->assertTrue($expected === $date1->equal($date2));
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
        $date1 = Date::ofByString($dateString1);
        $date2 = Date::ofByString($dateString2);

        $this->assertTrue($expected === $date1->isBeforeOrEqual($date2));
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
        $date1 = Date::ofByString($dateString1);
        $date2 = Date::ofByString($dateString2);

        $this->assertTrue($expected === $date1->isAfter($date2));
    }

    public function dataIsAfter()
    {
        return [
            ['2019-08-25', '2019-08-25', false],
            ['2019-08-25', '2019-08-26', false],
            ['2019-08-25', '2019-08-24', true],
        ];
    }

    /**
     * @param $dateString
     * @dataProvider dataToString
     */
    public function testToString($dateString)
    {
        $date = Date::ofByString($dateString);
        $this->assertTrue($date->toString() == $dateString);
    }

    /**
     * @param $dateString
     * @dataProvider dataToString
     */
    public function testToStringMagicMethod($dateString)
    {
        $date = Date::ofByString($dateString);
        $this->assertTrue(htmlspecialchars($date) === $dateString);
    }

    public function dataToString()
    {
        return [
            ['2019-01-01'],
            ['2019-10-10'],
        ];
    }

    public function testValue()
    {
        $dateString = '2019-08-25';
        $date = Date::ofByString($dateString);

        $this->assertTrue($date->value() == new DateTimeImmutable($dateString));
    }
}
