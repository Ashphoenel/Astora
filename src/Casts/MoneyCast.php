<?php

declare(strict_types=1);

namespace Ashphoenel\Astora\Casts;

use Ashphoenel\Astora\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

abstract class MoneyCast implements CastsAttributes
{
    protected ?string $currency;

    protected bool $forceDecimals = false;

    public function __construct(?string $currency = null, $forceDecimals = null)
    {
        $this->currency = $currency;
        $this->forceDecimals = is_string($forceDecimals)
            ? filter_var($forceDecimals, FILTER_VALIDATE_BOOLEAN)
            : (bool) $forceDecimals;
    }

    abstract protected function getFormatter(Money $money): string | float | int;

    public function get($model, string $key, $value, array $attributes): ?Money
    {
        if ($value === null) {
            return null;
        }

        return Money::parse($value, $this->getCurrency($attributes), $this->forceDecimals);
    }

    public function set($model, string $key, $value, array $attributes): array
    {
        if ($value === null) {
            return [$key => $value];
        }

        try {
            $money = Money::parse($value, $this->getCurrency($attributes), $this->forceDecimals);
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException(
                sprintf('Invalid data provided for %s::$%s', get_class($model), $key)
            );
        }

        $amount = $this->getFormatter($money);

        if ($this->currency && ! Money::isValidCurrency($this->currency)) {
            return [$key => $amount, $this->currency => $money->getCurrency()->getCode()];
        }

        return [$key => $amount];
    }

    protected function getCurrency(array $attributes): \Money\Currency
    {
        $defaultCode = Money::getDefaultCurrency();

        if ($this->currency === null) {
            return Money::parseCurrency($defaultCode);
        }

        $currency = Money::parseCurrency($this->currency);
        $currencies = Money::getCurrencies();

        if ($currencies->contains($currency)) {
            return $currency;
        }

        $code = $attributes[$this->currency] ?? $defaultCode;

        return Money::parseCurrency($code);
    }
}
