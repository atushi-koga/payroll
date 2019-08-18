<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Employee;

class Employee
{
    /** @var EmployeeNumber */
    private $employeeNumber;

    /** @var Name */
    private $name;

    /** @var MailAddress */
    private $mailAddress;

    /** @var PhoneNumber */
    private $phoneNumber;

    /**
     * Employee constructor.
     * @param EmployeeNumber $employeeNumber
     * @param Name $name
     * @param MailAddress $mailAddress
     * @param PhoneNumber $phoneNumber
     */
    public function __construct(
        EmployeeNumber $employeeNumber,
        Name $name,
        MailAddress $mailAddress,
        PhoneNumber $phoneNumber
    ) {
        $this->employeeNumber = $employeeNumber;
        $this->name = $name;
        $this->mailAddress = $mailAddress;
        $this->phoneNumber = $phoneNumber;
    }


}
