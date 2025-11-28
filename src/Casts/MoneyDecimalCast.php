<?php

declare(strict_types=1);

namespace Ashphoenel\Astora\Casts;

use Ashphoenel\Astora\Money;

class MoneyDecimalCast extends MoneyCast
{
    protected function getFormatter(Money $money): float
    {
        return (float) $money->formatByDecimal();
    }
}
