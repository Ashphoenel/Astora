<?php

declare(strict_types=1);

namespace Ashphoenel\Astora\Models;

use Ashphoenel\Astora\Casts\MoneyDecimalCast;
use Ashphoenel\Astora\Concerns\MaskedIdentifier;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property \Ashphoenel\Astora\Money $subtotal Items total.
 * @property \Ashphoenel\Astora\Money $base_price Product base price.
 * @property \Ashphoenel\Astora\Contracts\Product | null $product
 */
class CartItem extends Model
{
    use MaskedIdentifier;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subtotal',
        'base_price',
        'currency',
        'quantity',
        'product_id',
        'product_type',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'base_price' => MoneyDecimalCast::class.':currency',
            'subtotal' => MoneyDecimalCast::class.':currency',
        ];
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): MorphTo
    {
        return $this->morphTo('product');
    }
}
