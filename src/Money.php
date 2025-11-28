<?php

declare(strict_types=1);

namespace Ashphoenel\Astora;

class Money extends \Cknow\Money\Money
{
    /**
     * Returns the currency code.
     */
    public function getCurrencyCode(): string
    {
        return $this->getCurrency()->getCode();
    }
}
