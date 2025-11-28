<?php

namespace Ashphoenel\Astora\Models;

use Ashphoenel\Astora\Casts\MoneyDecimalCast;
use Ashphoenel\Astora\Concerns\MaskedIdentifier;
use Ashphoenel\Astora\States\Cart\CartState;
use Carbon\Carbon;
use DateInterval;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property \Ashphoenel\Astora\Money $subtotal Items total before any adjustments.
 * @property \Ashphoenel\Astora\Money $total Final payable amount after all adjustments.
 * @property \Ashphoenel\Astora\Contracts\Customer | null $customer
 */
class Cart extends Model
{
    use MaskedIdentifier;

    protected static function booted(): void
    {
        static::creating(fn (Cart $cart) => $cart->expires_at = $cart->getExpiresAt());
        static::updating(fn (Cart $cart) => $cart->expires_at = $cart->getExpiresAt());
    }

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
        'owner_key',
        'subtotal',
        'total',
        'currency',
        'state',
        'expires_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'subtotal' => MoneyDecimalCast::class.':currency',
            'total' => MoneyDecimalCast::class.':currency',
            'state' => CartState::class,
            'expires_at' => 'datetime',
        ];
    }

    public function customer(): MorphTo
    {
        return $this->morphTo('customer');
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    protected function getExpiresAt(): Carbon
    {
        return now()->add($this->getExpiresAtInterval());
    }

    protected function getExpiresAtInterval(): DateInterval
    {
        return new DateInterval(config('astora.cart.expires_after'));
    }
}
