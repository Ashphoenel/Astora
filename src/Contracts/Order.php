<?php

declare(strict_types=1);

namespace Ashphoenel\Astora\Contracts;

interface Order extends Morphable
{
    public function getCustomer(): Customer;
}
