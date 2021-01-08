<?php

namespace App\Providers;

use App\Interfaces\Repositories\IBonusRepository;
use App\Interfaces\Repositories\IBonusService;
use App\Interfaces\Repositories\IRewardCoefficientRepository;
use App\Interfaces\Repositories\IRewardRepository;
use App\Interfaces\Repositories\ITypeRewardRepository;
use App\Interfaces\Services\IBonusMoneyExchangeService;
use App\Interfaces\Services\IPrizeGeneratorService;
use App\Interfaces\Services\IStripeRemoteService;
use App\Repositories\BonusRepository;
use App\Repositories\RewardCoefficientRepository;
use App\Repositories\RewardRepository;
use App\Repositories\TypeRewardRepository;
use App\Services\BonusMoneyExchangeService;
use App\Services\BonusService;
use App\Services\PrizeGeneratorService;
use App\Services\StripeRemoteService;
use Illuminate\Support\ServiceProvider;
use Stripe\BaseStripeClient;
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
        $this->app->instance(BaseStripeClient::class, new StripeClient(env('STRIPE_API_KEY')));
        $this->app->singleton(IBonusService::class, BonusService::class);
        $this->app->singleton(IBonusRepository::class, BonusRepository::class);
        $this->app->singleton(IRewardRepository::class, RewardRepository::class);
        $this->app->singleton(IStripeRemoteService::class, StripeRemoteService::class);
        $this->app->singleton(IBonusMoneyExchangeService::class, BonusMoneyExchangeService::class);
        $this->app->singleton(IRewardCoefficientRepository::class, RewardCoefficientRepository::class);
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
