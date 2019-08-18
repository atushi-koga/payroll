<?php
declare(strict_types=1);

namespace App\Http\Controllers\Employee;

use Payroll\Domain\Model\Employee\MailAddress;
use Payroll\Domain\Model\Employee\Name;
use Payroll\Domain\Model\Employee\PhoneNumber;
use Payroll\Domain\Model\Employee\Profile;

class NewEmployee
{
    /** @var Name */
    private $name;

    /** @var MailAddress */
    private $mailAddress;

    /** @var PhoneNumber */
    private $phoneNumber;

    /**
     * NewEmployee constructor.
     * @param Name $name
     * @param MailAddress $mailAddress
     * @param PhoneNumber $phoneNumber
     */
    public function __construct(Name $name, MailAddress $mailAddress, PhoneNumber $phoneNumber)
    {
        $this->name = $name;
        $this->mailAddress = $mailAddress;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return Name
     */
    public function name(): Name
    {
        return $this->name;
    }

    /**
     * @return MailAddress
     */
    public function mailAddress(): MailAddress
    {
        return $this->mailAddress;
    }

    /**
     * @return PhoneNumber
     */
    public function phoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }

    public function profile(): Profile
    {
        return new Profile(
            $this->name,
            $this->mailAddress,
            $this->phoneNumber
        );
    }
}
