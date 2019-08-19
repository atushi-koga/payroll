<?php
declare(strict_types=1);

namespace Payroll\App\Coordinator;


use Payroll\App\Service\EmployeeRecordService;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\Employee\Profile;

class EmployeeRecordCoordinator
{
    /** @var EmployeeRecordService */
    private $employeeRecordService;

    public function __construct(EmployeeRecordService $employeeRecordService)
    {
        $this->employeeRecordService = $employeeRecordService;
    }

    public function register(Profile $profile): EmployeeNumber
    {
        $employeeNumber = $this->employeeRecordService->prepareNewContract();
        $this->employeeRecordService->registerName($employeeNumber, $profile->name());
        $this->employeeRecordService->registerMailAddress($employeeNumber, $profile->mailAddress());
        $this->employeeRecordService->registerPhoneNumber($employeeNumber, $profile->phoneNumber());
        $this->employeeRecordService->inspireContract($employeeNumber);

        return $employeeNumber;
    }
}
