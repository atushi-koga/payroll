<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Wage;

use Payroll\Domain\Model\Legislation\MidnightExtraRate;
use Payroll\Domain\Model\Legislation\OverTimeExtraRate;

class WageCondition
{
    /** @var HourlyWage */
    private $baseHourlyWage;

    /** @var OverTimeExtraRate */
    private $overTimeExtraRate;

    /** @var MidnightExtraRate */
    private $midnightExtraRate;

    public function __construct(
        HourlyWage $baseHourlyWage,
        OverTimeExtraRate $overTimeExtraRate,
        MidnightExtraRate $midnightExtraRate
    ) {
        $this->baseHourlyWage = $baseHourlyWage;
        $this->overTimeExtraRate = $overTimeExtraRate;
        $this->midnightExtraRate = $midnightExtraRate;
    }

    public static function of(
        HourlyWage $baseHourlyWage,
        OverTimeExtraRate $overTimeExtraRate,
        MidnightExtraRate $midnightExtraRate
    ): self {
        return new self($baseHourlyWage, $overTimeExtraRate, $midnightExtraRate);
    }

    public static function ofLegalRate(HourlyWage $baseHourlyWage): self
    {
        return new self($baseHourlyWage, OverTimeExtraRate::ofLegalRate(), MidnightExtraRate::ofLegalRate());
    }

    /**
     * @return HourlyWage
     */
    public function baseHourlyWage(): HourlyWage
    {
        return $this->baseHourlyWage;
    }

    /**
     * @return OverTimeExtraRate
     */
    public function overTimeExtraRate(): OverTimeExtraRate
    {
        return $this->overTimeExtraRate;
    }

    /**
     * @return MidnightExtraRate
     */
    public function midnightExtraRate(): MidnightExtraRate
    {
        return $this->midnightExtraRate;
    }
}
