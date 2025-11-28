<?php

use Ashphoenel\Astora\Contracts\CurrencyConverter;
use Ashphoenel\Astora\Money;
use Money\Currency;

if (! function_exists('convert')) {
    /**
     * Convert money to another currency using the bound CurrencyConverter.
     */
    function convert(Money $money, Currency|string $toCurrency): Money
    {
        return app(CurrencyConverter::class)->convert($money, $toCurrency);
    }
}
