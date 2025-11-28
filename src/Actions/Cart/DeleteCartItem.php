<?php

namespace Ashphoenel\Astora\Actions\Cart;

use Ashphoenel\Astora\Actions\Action;
use Ashphoenel\Astora\Models\CartItem;

class DeleteCartItem extends Action
{
    public function __construct(
        protected Sync $syncCart,
    ) {}

    public function execute(
        CartItem $cartItem,
        bool $sync = true,
    ): bool {

        $result = $cartItem->delete();

        if ($sync) {
            $this->syncCart->execute($cartItem->cart);
        }

        return $result;
    }
}
