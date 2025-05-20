<?php

namespace App\Providers;

use App\Repositories\HubRepository;
use App\Repositories\MarketplaceRepository;
use App\UseCases\Contracts\Repositories\IHubRepositoryInterface;
use App\UseCases\Contracts\Repositories\IMarketplaceRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IMarketplaceRepositoryInterface::class, MarketplaceRepository::class);
        $this->app->bind(IHubRepositoryInterface::class, HubRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
