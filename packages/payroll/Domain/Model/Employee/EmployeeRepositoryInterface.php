<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Employee;

interface EmployeeRepositoryInterface
{
    public function registerNew();

    public function newEmployeeNumber();

    public function insertEmployee(EmployeeNumber $employeeNumber);

    public function registerName(EmployeeNumber $employeeNumber, Name $name);

    public function registerMailAddress(EmployeeNumber $employeeNumber, MailAddress $mailAddress);

    public function registerPhoneNumber(EmployeeNumber $employeeNumber, PhoneNumber $phoneNumber);

    public function registerInspireContract(EmployeeNumber $employeeNumber);

    public function choose(EmployeeNumber $employeeNumber);

    public function underContracts();
}
