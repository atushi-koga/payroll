<?php
declare(strict_types=1);

namespace Payroll\Domain\Model\Contract;

use Payroll\Domain\Common\EnumTrait;

/**
 * @method static self noContract()
 * @method static self underContract()
 */
class ContractStatus
{
    use EnumTrait;

    const ENUM = [
        'noContract'    => 10,
        'underContract' => 20,
    ];

    public function isDisable(): bool
    {
        return $this->value() === 10;
    }
}
