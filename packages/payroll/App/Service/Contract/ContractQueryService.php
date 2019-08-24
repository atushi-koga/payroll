<?php
declare(strict_types=1);

namespace Payroll\App\Service\Contract;

use Payroll\Domain\Model\Contract\ContractRepositoryInterface;
use Payroll\Domain\Model\Contract\Contracts;
use Payroll\Domain\Model\Employee\ContractingEmployees;

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
}
