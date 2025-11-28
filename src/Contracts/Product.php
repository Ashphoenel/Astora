<?php

declare(strict_types=1);

namespace Ashphoenel\Astora\Contracts;

use Ashphoenel\Astora\Money;

interface Product extends Morphable
{
    public function getName(string $locale = 'en'): string;

    public function getPrice(): Money;
}
