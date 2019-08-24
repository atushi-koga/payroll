<?php
declare(strict_types=1);

namespace Payroll\App\Service;


use Payroll\Domain\Model\Employee\ContractingEmployees;
use Payroll\Domain\Model\Employee\Employee;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\Employee\EmployeeRepositoryInterface;

class EmployeeQueryService
{
    /** @var EmployeeRepositoryInterface */
    private $employeeRepo;

    public function __construct(EmployeeRepositoryInterface $employeeRepo)
    {
        $this->employeeRepo = $employeeRepo;
    }

    public function choose(EmployeeNumber $employeeNumber): Employee
    {
        return $this->employeeRepo->choose($employeeNumber);
    }

    public function contractingEmployees(): ContractingEmployees
    {
        return $this->employeeRepo->underContracts();
    }
}
