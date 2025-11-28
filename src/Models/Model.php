<?php

declare(strict_types=1);

namespace Ashphoenel\Astora\Models;

use Ashphoenel\Astora\Contracts\Morphable;
use Illuminate\Database\Eloquent\Model as BaseModel;

abstract class Model extends BaseModel implements Morphable
{
    public function scopeWhereMorphedTo($query, string $column, Morphable $model)
    {
        return $query->where("{$column}_id", $model->getKey())
            ->where("{$column}_type", $model->getMorphClass());
    }
}
