<?php

namespace Ashphoenel\Astora\States\Cart;

class Locked extends CartState
{
    public function color(): string
    {
        return 'green';
    }
}
