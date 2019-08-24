<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Contract;

/*
 * 契約給与一覧
 */

class ContractWages
{
    /** @var ContractWage[] */
    private $list;

    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public static function of(array $list): self
    {
        return new self($list);
    }

    /**
     * 適用開始日の降順にソートしたものを返す
     *
     * @return ContractWage[]
     */
    public function list(): array
    {
        usort($this->list, function ($contractWage1, $contractWage2) {
            $contractStartingDate1 = $contractWage1->startDate();
            $contractStartingDate2 = $contractWage2->startDate();

            if ($contractStartingDate1->equal($contractStartingDate2->value())) {
                return 0;
            }

            if ($contractStartingDate1->isAfter($contractStartingDate2->value())) {
                return -1;
            }

            return 1;
        });

        return $this->list;
    }
}
