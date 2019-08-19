<?php
declare(strict_types=1);

namespace Payroll\App\Service;


use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\Employee\EmployeeRepositoryInterface;
use Payroll\Domain\Model\Employee\MailAddress;
use Payroll\Domain\Model\Employee\Name;
use Payroll\Domain\Model\Employee\PhoneNumber;

class EmployeeRecordService
{
    /** @var EmployeeRepositoryInterface */
    private $employeeRepo;

    public function __construct(EmployeeRepositoryInterface $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    /**
     * @return EmployeeNumber
     */
    public function prepareNewContract()
    {
        return $this->employeeRepo->registerNew();
    }

    public function registerName(EmployeeNumber $employeeNumber, Name $name)
    {
        $this->employeeRepo->registerName($employeeNumber, $name);
    }

    public function registerMailAddress(EmployeeNumber $employeeNumber, MailAddress $mailAddress)
    {
        $this->employeeRepo->registerMailAddress($employeeNumber, $mailAddress);
    }

    public function registerPhoneNumber(EmployeeNumber $employeeNumber, PhoneNumber $phoneNumber)
    {
        $this->employeeRepo->registerPhoneNumber($employeeNumber, $phoneNumber);
    }

    /*
     * 従業員契約開始
     */
    public function inspireContract(EmployeeNumber $employeeNumber)
    {
        $this->employeeRepo->registerInspireContract($employeeNumber);
    }

}
