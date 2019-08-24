<?php

namespace Tests\Unit\payroll\Domain\Model\Legislation;

use Payroll\Domain\Model\Legislation\MidnightExtraRate;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MidnightExtraRateTest extends TestCase
{
    public function testOf()
    {
        $value = 30;
        $expected = new MidnightExtraRate($value);
        $this->assertTrue($expected == MidnightExtraRate::of($value));
    }

    public function testOfLegalRate()
    {
        $value = MidnightExtraRate::REGAL_RATE;
        $expected = new MidnightExtraRate($value);
        $this->assertTrue($expected == MidnightExtraRate::of($value));
    }

    public function testAsInt()
    {
        $value = 30;
        $this->assertTrue($value == MidnightExtraRate::of($value)->asInt());
    }

    public function testToStringMagicMethod()
    {
        $midnightExtraRate = MidnightExtraRate::of(30);
        $this->assertTrue(htmlspecialchars($midnightExtraRate) === '30');
    }
}
