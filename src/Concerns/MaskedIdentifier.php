<?php

declare(strict_types=1);

namespace Ashphoenel\Astora\Concerns;

use Ashphoenel\Astora\Contracts\Morphable;

trait MaskedIdentifier
{
    public static function bootMaskedIdentifier(): void
    {
        static::creating(function (Morphable $model) {
            $model->{$model->getKeyName()} = static::generateIdentifier();
        });

        static::saving(function (Morphable $model) {
            if (is_null($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = static::generateIdentifier();
            }
        });
    }

    protected static function generateMaskedIdentifier(): string
    {
        return str()->ulid()->toString();
    }
}
