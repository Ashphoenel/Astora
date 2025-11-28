<?php

declare(strict_types=1);

namespace Ashphoenel\Astora\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphOne;

interface Customer extends Morphable
{
    public function getFullName(): string;
    public function getUsername(): string;
    public function cart(): MorphOne;
}
