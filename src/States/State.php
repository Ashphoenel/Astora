<?php

namespace Ashphoenel\Astora\States;

use Spatie\ModelStates\State as SpatieState;
use Spatie\ModelStates\StateConfig;

abstract class State extends SpatieState
{
    abstract public static function config(): StateConfig;

    public static function getMorphClass(): string
    {
        return static::$name ?? static::getMapping() ?? static::class;
    }

    protected static function getMapping(): string
    {
        return str(class_basename(static::class))->kebab()->toString();
    }
}
