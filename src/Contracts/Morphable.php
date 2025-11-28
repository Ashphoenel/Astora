<?php

declare(strict_types=1);

namespace Ashphoenel\Astora\Contracts;

interface Morphable
{
    public function getKey(): mixed;
    public function getKeyName(): string;
    public function getMorphClass(): string;
}
