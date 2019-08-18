<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Employee;

class Profile
{
    /** @var Name */
    private $name;

    /** @var MailAddress */
    private $mailAddress;

    /** @var PhoneNumber */
    private $phoneNumber;

    /**
     * Profile constructor.
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
}
