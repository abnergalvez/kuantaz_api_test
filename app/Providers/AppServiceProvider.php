<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\BenefitsServiceContract;
use App\Contracts\FiltersServiceContract;
use App\Contracts\ProcessedBenefitsServiceContract;
use App\Contracts\ProfilesServiceContract;
use App\Services\HttpBenefitsService;
use App\Services\HttpFiltersService;
use App\Services\HttpProfilesService;
use App\Services\ProcessedBenefitsService;

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

        $this->app->bind(
            ProcessedBenefitsServiceContract::class,
            ProcessedBenefitsService::class
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
