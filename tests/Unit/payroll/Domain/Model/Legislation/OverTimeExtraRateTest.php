<?php

namespace Tests\Unit\payroll\Domain\Model\Legislation;

use Payroll\Domain\Model\Legislation\OverTimeExtraRate;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OverTimeExtraRateTest extends TestCase
{
    public function testOfLegalRate()
    {
        $expected = new OverTimeExtraRate(OverTimeExtraRate::REGAL_RATE);
        $this->assertTrue($expected == OverTimeExtraRate::ofLegalRate());
    }

    public function testAsInt()
    {
        $value = 30;
        $overTimeExtraRate = OverTimeExtraRate::of($value);
        $this->assertTrue($overTimeExtraRate->asInt() === $value);
    }

    public function testToStringMagicMethod()
    {
        $overTimeExtraRate = OverTimeExtraRate::of(30);
        $this->assertTrue(htmlspecialchars($overTimeExtraRate) === '30');
    }
}
