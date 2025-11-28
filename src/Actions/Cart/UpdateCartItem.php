<?php

namespace Ashphoenel\Astora\Actions\Cart;

use Ashphoenel\Astora\Actions\Action;
use Ashphoenel\Astora\Contracts\CurrencyConverter;
use Ashphoenel\Astora\Data\CartItemData;
use Ashphoenel\Astora\Models\CartItem;

class UpdateCartItem extends Action
{
    public function __construct(
        protected CurrencyConverter $converter,
        protected Sync $syncCart,
    ) {}

    public function execute(
        CartItem $cartItem,
        CartItemData $data,
        bool $sync = true
    ): CartItem {
        $basePrice = $this->converter->convert(
            $data->base_price ?? $cartItem->product->getPrice(),
            $cartItem->cart->currency
        );

        $cartItem->update([
            ...$data->except('base_price')->toArray(),
            'base_price' => $basePrice,
            'currency' => $cartItem->cart->currency,
        ]);

        if ($sync) {
            $this->syncCart->execute($cartItem->cart);
        }

        return $cartItem;
    }
}
