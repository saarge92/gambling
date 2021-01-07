<?php

namespace App\Providers;

use App\Interfaces\Repositories\IBonusService;
use App\Interfaces\Repositories\ITypeRewardRepository;
use App\Interfaces\Services\BonusService;
use App\Interfaces\Services\IPrizeGeneratorService;
use App\Interfaces\Services\IStripeRemoteService;
use App\Repositories\TypeRewardRepository;
use App\Services\PrizeGeneratorService;
use App\Services\StripeRemoteService;
use Illuminate\Support\ServiceProvider;
use Stripe\StripeClient;

/**
 * Провайдер инверсий зависимостей
 * @package App\Providers
 */
class IoCProvider extends ServiceProvider
{
    protected $defer = false;


    /**
     * Регистрация инверсии зависимостей
     */
    public function register()
    {
        $this->app->singleton(ITypeRewardRepository::class, TypeRewardRepository::class);
        $this->app->singleton(IPrizeGeneratorService::class, PrizeGeneratorService::class);
        $this->app->singleton(IStripeRemoteService::class, StripeRemoteService::class);
        $this->app->singleton(StripeClient::class, new StripeClient(env('STRIPE_API_CLIENT')));
        $this->app->singleton(IBonusService::class, BonusService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
