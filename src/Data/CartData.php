<?php

namespace Ashphoenel\Astora\Data;

use Ashphoenel\Astora\Money;
use Ashphoenel\Astora\Transformers\MoneyDecimalTransformer;
use Spatie\LaravelData\Attributes\WithTransformer;

class CartData extends Data
{
    public function __construct(
        public readonly string $currency,
        #[WithTransformer(MoneyDecimalTransformer::class)]
        public readonly Money $subtotal,
        #[WithTransformer(MoneyDecimalTransformer::class)]
        public readonly Money $total
    ) {}
}
