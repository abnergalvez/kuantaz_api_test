<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\BeneficiosServiceContract;
use App\Services\HttpBeneficiosService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            BeneficiosServiceContract::class,
            HttpBeneficiosService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
