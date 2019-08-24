<?php
declare(strict_types=1);

namespace Payroll\Infra\Repository\Contract;

use Illuminate\Support\Facades\DB;
use Payroll\Domain\Model\Contract\Contract;
use Payroll\Domain\Model\Contract\ContractRepositoryInterface;
use Payroll\Domain\Model\Contract\Contracts;
use Payroll\Domain\Model\Contract\ContractStartingDate;
use Payroll\Domain\Model\Contract\ContractWage;
use Payroll\Domain\Model\Contract\ContractWages;
use Payroll\Domain\Model\Employee\ContractingEmployees;
use Payroll\Domain\Model\Employee\Employee;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\Legislation\MidnightExtraRate;
use Payroll\Domain\Model\Legislation\OverTimeExtraRate;
use Payroll\Domain\Model\Wage\HourlyWage;
use Payroll\Domain\Model\Wage\WageCondition;
use Payroll\Domain\Type\Date\Date;
use Payroll\Domain\Type\Date\DateTime;
use Payroll\Domain\Type\Money\Money;
use stdClass;

class ContractRepository implements ContractRepositoryInterface
{
    public function registerHourlyWage(EmployeeNumber $employeeNumber, Date $startDate, WageCondition $wageCondition)
    {
        $this->deleteContract($employeeNumber, $startDate);
        $hourlyWageId = $this->newHourlyWageId();
        $this->insertHourlyWageContractHistories($hourlyWageId, $employeeNumber, $startDate, $wageCondition);
        $this->insertHourlyWageContracts($employeeNumber, $startDate, $wageCondition);
    }

    public function deleteContract(EmployeeNumber $employeeNumber, Date $startDate): void
    {
        DB::table('hourly_wage_contracts')
            ->where('employee_id', $employeeNumber->value())
            ->where('apply_date', $startDate->value())
            ->delete();
    }

    public function newHourlyWageId(): int
    {
        $result = DB::selectOne("select nextval('hourly_wage_contract_histories_hourly_wage_id_seq')");

        return $result->nextval;
    }

    public function insertHourlyWageContractHistories(
        int $hourlyWageId,
        EmployeeNumber $employeeNumber,
        Date $startDate,
        WageCondition $wageCondition
    ) {
        DB::table('hourly_wage_contract_histories')
            ->insert([
                'hourly_wage_id'              => $hourlyWageId,
                'employee_id'                 => $employeeNumber->value(),
                'hourly_wage'                 => $wageCondition->baseHourlyWage()->value()->asInt(),
                'over_time_hourly_extra_wage' => $wageCondition->overTimeExtraRate()->asInt(),
                'midnight_hourly_extra_wage'  => $wageCondition->midnightExtraRate()->asInt(),
                'apply_date'                  => $startDate->toString(),
                'created_at'                  => DateTime::now()->toString(),
            ]);
    }

    public function insertHourlyWageContracts(
        EmployeeNumber $employeeNumber,
        Date $startDate,
        WageCondition $wageCondition
    ) {
        DB::table('hourly_wage_contracts')
            ->insert([
                'employee_id'                 => $employeeNumber->value(),
                'hourly_wage'                 => $wageCondition->baseHourlyWage()->value()->asInt(),
                'over_time_hourly_extra_wage' => $wageCondition->overTimeExtraRate()->asInt(),
                'midnight_hourly_extra_wage'  => $wageCondition->midnightExtraRate()->asInt(),
                'apply_date'                  => $startDate->toString(),
                'created_at'                  => DateTime::now()->toString(),
            ]);
    }

    public function findContracts(ContractingEmployees $contractingEmployees): Contracts
    {
        $contracts = [];
        foreach ($contractingEmployees->list() as /** @var Employee $employee */ $employee) {
            $contracts[] = Contract::of($employee, $this->getContractWages($employee->employeeNumber()));
        }

        return Contracts::of($contracts);
    }

    private function getContractWages(EmployeeNumber $employeeNumber): ContractWages
    {
        $hourlyWageContracts = $this->selectHourlyWageContracts($employeeNumber);

        $contractWages = [];
        foreach ($hourlyWageContracts as $hourlyWageContract) {
            $contractWages[] = $this->toContractWage($hourlyWageContract);
        }

        return ContractWages::of($contractWages);
    }

    private function toContractWage(stdClass $hourlyWageContract): ContractWage
    {
        return ContractWage::of(
            ContractStartingDate::ofByString($hourlyWageContract->apply_date),
            WageCondition::of(
                HourlyWage::of(Money::of($hourlyWageContract->hourly_wage)),
                OverTimeExtraRate::of($hourlyWageContract->over_time_hourly_extra_wage),
                MidnightExtraRate::of($hourlyWageContract->midnight_hourly_extra_wage)
            )
        );
    }

    private function selectHourlyWageContracts(EmployeeNumber $employeeNumber): array
    {
        $sql = "
SELECT
     apply_date
     ,hourly_wage
     ,over_time_hourly_extra_wage
     ,midnight_hourly_extra_wage
FROM
    hourly_wage_contracts
WHERE
    employee_id = ?
";

        return DB::select($sql, [$employeeNumber->value()]);
    }
}
