<?php

namespace Ashphoenel\Astora\States\Cart;

use Ashphoenel\Astora\States\State;
use Spatie\ModelStates\StateConfig;

/**
 * @extends State<\Ashphoenel\Astora\Contracts\Cart>
 */
abstract class CartState extends State
{
    abstract public function color(): string;

    public static function config(): StateConfig
    {
        return parent::config();
        // ->default(Pending::class)
        // ->allowTransition(Pending::class, Paid::class)
        // ->allowTransition(Pending::class, Failed::class)
    }
}
