<?php

namespace Ashphoenel\Astora\Converters;

use Ashphoenel\Astora\Contracts\CurrencyConverter;
use Ashphoenel\Astora\Money;
use Money\Converter;
use Money\Currencies;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Exchange\FixedExchange;

class FixedRateCurrencyConverter implements CurrencyConverter
{
    /**
     * @param array<string, array<string, float|int|string>> $exchangeRates Base => [Counter => rate]
     */
    public function __construct(
        protected array $exchangeRates = [],
        protected int $roundingMode = \Money\Money::ROUND_HALF_UP,
        protected ?Currencies $currencies = null,
    ) {
    }

    public function convert(Money $money, Currency|string $toCurrency): Money
    {
        $counterCurrency = $toCurrency instanceof Currency ? $toCurrency : new Currency($toCurrency);

        $converter = new Converter(
            $this->currencies ?? new ISOCurrencies(),
            new FixedExchange($this->exchangeRates)
        );

        $converted = $converter->convert(
            $money->getMoney(),
            $counterCurrency,
            $this->roundingMode
        );

        return Money::convert($converted);
    }
}
