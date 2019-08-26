<?php
declare(strict_types=1);

namespace Payroll\App\Service\Contract;

use Payroll\Domain\Model\Contract\ContractRepositoryInterface;
use Payroll\Domain\Model\Contract\Contracts;
use Payroll\Domain\Model\Contract\ContractWages;
use Payroll\Domain\Model\Employee\ContractingEmployees;
use Payroll\Domain\Model\Employee\EmployeeNumber;

class ContractQueryService
{
    /** @var ContractRepositoryInterface */
    private $contractRepo;

    public function __construct(ContractRepositoryInterface $contractRepo)
    {
        $this->contractRepo = $contractRepo;
    }

    public function findContracts(ContractingEmployees $contractingEmployees): Contracts
    {
        return $this->contractRepo->findContracts($contractingEmployees);
    }

    public function getContractWages(EmployeeNumber $employeeNumber): ContractWages
    {
        return $this->contractRepo->getContractWages($employeeNumber);
    }
}
