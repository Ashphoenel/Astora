<?php

namespace Ashphoenel\Astora;

use Ashphoenel\Astora\Commands\AstoraCommand;
use Ashphoenel\Astora\Contracts\CurrencyConverter;
use Ashphoenel\Astora\Converters\FixedRateCurrencyConverter;
use Ashphoenel\Astora\Transformers\MoneyDecimalTransformer;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AstoraServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('astora')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_astora_table')
            ->hasCommand(AstoraCommand::class);
    }

    public function packageRegistered()
    {
        config()->set(
            'data.transformers',
            array_merge(
                [Money::class => MoneyDecimalTransformer::class],
                config('data.transformers', []),
            )
        );

        $this->app->singleton(CurrencyConverter::class, function () {
            $config = config('astora.currency', []);
            $converterClass = $config['converter'] ?? FixedRateCurrencyConverter::class;

            if ($converterClass !== FixedRateCurrencyConverter::class) {
                return app($converterClass);
            }

            return new FixedRateCurrencyConverter(
                $config['exchange_rates'] ?? [],
                $config['rounding_mode'] ?? \Money\Money::ROUND_HALF_UP
            );
        });
    }
}
