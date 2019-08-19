<?php
declare(strict_types=1);

namespace Payroll\Infra\Repository\Contract;

use Illuminate\Support\Facades\DB;
use Payroll\Domain\Model\Contract\ContractRepositoryInterface;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\Wage\WageCondition;
use Payroll\Domain\Type\Date\Date;
use Payroll\Domain\Type\Date\DateTime;

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
}
