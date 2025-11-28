<?php

namespace Ashphoenel\Astora\Actions\Cart;

use Ashphoenel\Astora\Actions\Action;
use Ashphoenel\Astora\Contracts\Product;
use Ashphoenel\Astora\Data\CartItemData;
use Ashphoenel\Astora\Models\Cart;
use Ashphoenel\Astora\Models\CartItem;

class SetCartItem extends Action
{
    public function __construct(
        protected AddCartItem $add,
        protected UpdateCartItem $update,
        protected DeleteCartItem $delete,
    ) {}

    public function execute(
        Cart &$cart,
        Product $product,
        CartItemData $data,
        bool $sync = true,
    ): ?CartItem {

        $cartItem = $cart->cartItems()
            ->whereMorphedTo('product', $product)
            ->first();

        if ($data->quantity > 0) {
            $cartItem = filled($cartItem) ?
                $this->update->execute($cartItem, $data, $sync) :
                $this->add->execute($cart, $product, $data, $sync) ;
        } else {
            if ($cartItem) {
                $this->delete->execute($cartItem, $sync);
                $cartItem = null;
            }
        }

        return $cartItem;
    }
}
