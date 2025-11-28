<?php

namespace Ashphoenel\Astora\Actions\Cart;

use Ashphoenel\Astora\Actions\Action;
use Ashphoenel\Astora\Contracts\CurrencyConverter;
use Ashphoenel\Astora\Contracts\Product;
use Ashphoenel\Astora\Data\CartItemData;
use Ashphoenel\Astora\Models\Cart;
use Ashphoenel\Astora\Models\CartItem;

class AddCartItem extends Action
{
    public function __construct(
        protected CurrencyConverter $converter,
        protected Sync $syncCart,
    ) {}

    public function execute(
        Cart &$cart,
        Product $product,
        CartItemData $data,
        bool $sync = true
    ): CartItem {
        $basePrice = $this->converter->convert(
            $data->base_price ?? $product->getPrice(),
            $cart->currency
        );

        $cartItem = $cart->cartItems()->create([
            ...$data->except('base_price')->toArray(),
            'product_id' => $product->getKey(),
            'product_type' => $product->getMorphClass(),
            'base_price' => $basePrice,
            'currency' => $cart->currency,
        ]);

        if ($sync) {
            $this->syncCart->execute($cart);
        }

        return $cartItem;
    }
}
