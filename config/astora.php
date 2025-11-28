<?php

/**
 * Astora configuration.
 *
 * Copy any option to your app config to override the defaults.
 */
return [
    /*
    |--------------------------------------------------------------------------
    | Cart settings
    |--------------------------------------------------------------------------
    |
    | expires_after
    |  ISO 8601 duration that determines how long a cart stays valid.
    |  Default: P3D (3 days). Override via ASTORA_CART_EXPIRES_AFTER.
    |
    */
    'cart' => [
        'expires_after' => env('ASTORA_CART_EXPIRES_AFTER', 'P3D'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Currency conversion
    |--------------------------------------------------------------------------
    |
    | converter
    |  The service bound to CurrencyConverter; swap with your own implementation.
    |
    | exchange_rates
    |  When using the default FixedRateCurrencyConverter, provide rates as:
    |  ['USD' => ['EUR' => 0.9, 'JPY' => 150], 'EUR' => ['USD' => 1.11]]
    |  Rates are interpreted as base => [counter => ratio].
    |
    | rounding_mode
    |  Rounding mode passed to moneyphp's converter. Defaults to Money::ROUND_HALF_UP.
    |
    */
    'currency' => [
        'converter' => \Ashphoenel\Astora\Converters\FixedRateCurrencyConverter::class,
        'exchange_rates' => [],
        'rounding_mode' => \Money\Money::ROUND_HALF_UP,
    ],
];
