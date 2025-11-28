<?php

namespace Ashphoenel\Astora\Transformers;

use Ashphoenel\Astora\Money;
use InvalidArgumentException;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class MoneyDecimalTransformer implements Transformer
{
    public function transform(DataProperty $property, mixed $value, TransformationContext $context): string
    {
        if (! $value instanceof Money) {
            throw new InvalidArgumentException(sprintf(
                'Expected %s to be an instance of %s, %s given.',
                $property->name,
                Money::class,
                get_debug_type($value),
            ));
        }

        return $value->formatByDecimal();
    }
}
