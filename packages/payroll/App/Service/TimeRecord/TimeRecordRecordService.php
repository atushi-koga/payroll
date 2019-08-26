<?php
declare(strict_types=1);

namespace Payroll\App\Service\TimeRecord;

use Payroll\App\Repository\TimeRecordRepository;
use Payroll\Domain\Model\TimeRecord\TimeRecord;

class TimeRecordRecordService
{
    /**
     * @var TimeRecordRepository
     */
    private $timeRecordRepository;

    public function __construct(TimeRecordRepository $timeRecordRepository)
    {
        $this->timeRecordRepository = $timeRecordRepository;
    }

    public function record(TimeRecord $timeRecord): void
    {
        $this->timeRecordRepository->registerTimeRecord($timeRecord);
    }
}
