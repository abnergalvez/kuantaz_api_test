<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\BenefitsServiceContract;
use App\Contracts\FiltersServiceContract;
use App\Contracts\ProfilesServiceContract;
use App\Services\HttpBenefitsService;
use App\Services\HttpFiltersService;
use App\Services\HttpProfilesService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            BenefitsServiceContract::class,
            HttpBenefitsService::class
        );

        $this->app->bind(
            FiltersServiceContract::class,
            HttpFiltersService::class
        );

        $this->app->bind(
            ProfilesServiceContract::class,
            HttpProfilesService::class
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
