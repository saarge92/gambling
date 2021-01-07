<?php

namespace App\Providers;

use App\Interfaces\Repositories\ITypeRewardRepository;
use App\Repositories\TypeRewardRepository;
use Illuminate\Support\ServiceProvider;

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