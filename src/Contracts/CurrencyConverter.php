<?php

namespace Ashphoenel\Astora\Contracts;

use Ashphoenel\Astora\Money;
use Money\Currency;

interface CurrencyConverter
{
    /**
     * Convert a money value to the given currency.
     */
    public function convert(Money $money, Currency|string $toCurrency): Money;
}
