<?php

namespace Ashphoenel\Astora\Actions\Cart;

use Ashphoenel\Astora\Actions\Action;
use Ashphoenel\Astora\Data\CartData;
use Ashphoenel\Astora\Models\Cart;
use Ashphoenel\Astora\Contracts\Customer;
use Ashphoenel\Astora\Exceptions\CustomerOrOwnerKeyRequiredException;

class GetCart extends Action
{
    /**
     * @throws CustomerOrOwnerKeyRequiredException When neither a customer nor an owner key (guest session) is provided.
     */
    public function execute(CartData $data, ?Customer $customer, ?string $ownerKey = null): Cart
    {

        throw_if(
            is_null($customer) && empty($ownerKey),
            CustomerOrOwnerKeyRequiredException::create()
        );

        return filled($customer) ?
            $customer->cart()->firstOrCreate([], $data->toArray()) :
            Cart::firstOrCreate([
                'owner_key' => $ownerKey,
            ], $data->toArray());
    }
}
