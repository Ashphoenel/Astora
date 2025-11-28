<?php

namespace Ashphoenel\Astora\Data;

use Ashphoenel\Astora\Money;

class CartItemData extends Data
{
    public function __construct(
        public readonly int $quantity,
        public readonly Money|null $base_price = null,
    ) {}
}
