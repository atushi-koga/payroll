<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Employee;

class ContractingEmployees
{
    /** @var Employee[] */
    private $list;

    /**
     * ContractingEmployees constructor.
     * @param Employee[] $list
     */
    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public static function of(array $list): self
    {
        return new self($list);
    }

    public function list(): array
    {
        return $this->list;
    }

}
