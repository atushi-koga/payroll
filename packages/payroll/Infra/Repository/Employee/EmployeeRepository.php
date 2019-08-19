<?php
declare(strict_types=1);

namespace Payroll\Infra\Repository\Employee;

use Illuminate\Support\Facades\DB;
use Payroll\Domain\Model\Employee\Employee;
use Payroll\Domain\Model\Employee\EmployeeNumber;
use Payroll\Domain\Model\Employee\EmployeeRepositoryInterface;
use Payroll\Domain\Model\Employee\MailAddress;
use Payroll\Domain\Model\Employee\Name;
use Payroll\Domain\Model\Employee\PhoneNumber;
use Payroll\Domain\Type\Date\DateTime;
use stdClass;

class EmployeeRepository implements EmployeeRepositoryInterface
{

    public function registerNew(): EmployeeNumber
    {
        $employeeNumber = new EmployeeNumber($this->newEmployeeNumber());
        $this->insertEmployee($employeeNumber);

        return $employeeNumber;
    }

    public function newEmployeeNumber(): int
    {
        $result = DB::selectOne("select nextval('employees_id_seq')");

        return $result->nextval;
    }

    public function insertEmployee(EmployeeNumber $employeeNumber)
    {
        DB::table('employees')
            ->insert([
                'id'         => $employeeNumber->value(),
                'created_at' => DateTime::now()->toString(),
            ]);
    }

    public function registerName(EmployeeNumber $employeeNumber, Name $name): void
    {
        $nameId = $this->newEmployeeNameNumber();
        $this->insertEmployeeNameHistory($nameId, $employeeNumber, $name);
        $this->deleteEmployeeName($employeeNumber);
        $this->insertEmployeeName($employeeNumber, $nameId, $name);
    }

    public function newEmployeeNameNumber(): int
    {
        $result = DB::selectOne("select nextval('employee_name_histories_employee_name_id_seq')");

        return $result->nextval;
    }

    public function insertEmployeeNameHistory(int $nameId, EmployeeNumber $employeeNumber, Name $name): void
    {
        DB::table('employee_name_histories')
            ->insert([
                'employee_name_id' => $nameId,
                'employee_id'      => $employeeNumber->value(),
                'name'             => $name->value(),
                'created_at'       => DateTime::now()->toString(),
            ]);
    }

    public function deleteEmployeeName(EmployeeNumber $employeeNumber)
    {
        DB::table('employee_names')
            ->where('employee_id', $employeeNumber->value())
            ->delete();
    }

    public function insertEmployeeName(EmployeeNumber $employeeNumber, int $nameId, Name $name)
    {
        DB::table('employee_names')
            ->insert([
                'employee_id'      => $employeeNumber->value(),
                'employee_name_id' => $nameId,
                'name'             => $name->value(),
                'created_at'       => DateTime::now()->toString(),
            ]);
    }

    public function registerMailAddress(EmployeeNumber $employeeNumber, MailAddress $mailAddress): void
    {
        $mailAddressId = $this->newEmployeeMailAddressNumber();
        $this->insertEmployeeMailAddressHistory($mailAddressId, $employeeNumber, $mailAddress);
        $this->deleteEmployeeMailAddress($employeeNumber);
        $this->insertEmployeeMailAddress($employeeNumber, $mailAddressId, $mailAddress);
    }

    public function newEmployeeMailAddressNumber(): int
    {
        $result = DB::selectOne("select nextval('employee_email_histories_employee_email_id_seq')");

        return $result->nextval;
    }

    public function insertEmployeeMailAddressHistory(
        int $mailAddressId,
        EmployeeNumber $employeeNumber,
        MailAddress $mailAddress
    ): void {
        DB::table('employee_email_histories')
            ->insert([
                'employee_email_id' => $mailAddressId,
                'employee_id'       => $employeeNumber->value(),
                'email'             => $mailAddress->value(),
                'created_at'        => DateTime::now()->toString(),
            ]);
    }

    public function deleteEmployeeMailAddress(EmployeeNumber $employeeNumber): void
    {
        DB::table('employee_emails')
            ->where('employee_id', $employeeNumber->value())
            ->delete();
    }

    public function insertEmployeeMailAddress(
        EmployeeNumber $employeeNumber,
        int $mailAddressId,
        MailAddress $mailAddress
    ) {
        DB::table('employee_emails')
            ->insert([
                'employee_id'       => $employeeNumber->value(),
                'employee_email_id' => $mailAddressId,
                'email'             => $mailAddress->value(),
                'created_at'        => DateTime::now()->toString(),
            ]);
    }

    public function registerPhoneNumber(EmployeeNumber $employeeNumber, PhoneNumber $phoneNumber): void
    {
        $phoneNumberId = $this->newEmployeePhoneNumberId();
        $this->insertEmployeePhoneNumberHistory($phoneNumberId, $employeeNumber, $phoneNumber);
        $this->deleteEmployeePhoneNumber($employeeNumber);
        $this->insertEmployeePhoneNumber($employeeNumber, $phoneNumberId, $phoneNumber);
    }

    public function newEmployeePhoneNumberId(): int
    {
        $result = DB::selectOne("select nextval('employee_phone_histories_employee_phone_id_seq')");

        return $result->nextval;
    }

    public function insertEmployeePhoneNumberHistory(
        int $phoneNumberId,
        EmployeeNumber $employeeNumber,
        PhoneNumber $phoneNumber
    ): void {
        DB::table('employee_phone_histories')
            ->insert([
                'employee_phone_id' => $phoneNumberId,
                'employee_id'       => $employeeNumber->value(),
                'phone'             => $phoneNumber->value(),
                'created_at'        => DateTime::now()->toString(),
            ]);
    }

    public function deleteEmployeePhoneNumber(EmployeeNumber $employeeNumber): void
    {
        DB::table('employee_phones')
            ->where('employee_id', $employeeNumber->value())
            ->delete();
    }

    public function insertEmployeePhoneNumber(
        EmployeeNumber $employeeNumber,
        int $phoneNumberId,
        PhoneNumber $phoneNumber
    ): void {
        DB::table('employee_phones')
            ->insert([
                'employee_id'       => $employeeNumber->value(),
                'employee_phone_id' => $phoneNumberId,
                'phone'             => $phoneNumber->value(),
                'created_at'        => DateTime::now()->toString(),
            ]);
    }


    public function registerInspireContract(EmployeeNumber $employeeNumber): void
    {
        DB::table('under_contract')
            ->insert([
                'employee_id' => $employeeNumber->value(),
                'created_at'  => DateTime::now()->toString(),
            ]);
    }

    public function choose(EmployeeNumber $employeeNumber): Employee
    {
        return $this->selectByEmployeeNumber($employeeNumber);
    }

    public function selectByEmployeeNumber(EmployeeNumber $employeeNumber): Employee
    {
        $query = "
SELECT
  sub_employees.id AS employee_id
  ,employee_names.name AS name
  ,employee_emails.email AS email
  ,employee_phones.phone AS phone
FROM
  (
    SELECT
      id
    FROM
      employees
    WHERE
      id = ?
  ) AS sub_employees
  INNER JOIN employee_names
  ON  employee_names.employee_id = sub_employees.id
  INNER JOIN employee_emails
  ON  employee_emails.employee_id = sub_employees.id
  INNER JOIN employee_phones
  ON  employee_phones.employee_id = sub_employees.id
  INNER JOIN under_contract
  ON  under_contract.employee_id = sub_employees.id
;
        ";
        $result = DB::selectOne($query, [$employeeNumber->value()]);

        return $this->toEmployee($result);
    }

    private function toEmployee(stdClass $result): Employee
    {
        return new Employee(
            EmployeeNumber::of($result->employee_id),
            Name::of($result->name),
            MailAddress::of($result->email),
            PhoneNumber::of($result->phone)
        );
    }
}
