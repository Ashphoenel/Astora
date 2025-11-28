<?php

namespace Ashphoenel\Astora\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ashphoenel\Astora\Astora
 */
class Astora extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ashphoenel\Astora\Astora::class;
    }
}
