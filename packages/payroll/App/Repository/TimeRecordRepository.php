<?php
declare(strict_types=1);

namespace Payroll\App\Repository;

use Payroll\Domain\Model\TimeRecord\TimeRecord;

interface TimeRecordRepository
{
    public function registerTimeRecord(TimeRecord $timeRecord): void;
}
