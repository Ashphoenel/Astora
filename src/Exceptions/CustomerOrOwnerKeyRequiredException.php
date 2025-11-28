<?php

namespace Ashphoenel\Astora\Exceptions;

use InvalidArgumentException;

class CustomerOrOwnerKeyRequiredException extends InvalidArgumentException
{
    public static function create(): self
    {
        return new self('Either a customer or an owner key (guest session) must be provided.');
    }
}
