<?php

namespace App\Providers;

use App\Interfaces\HubRepositoryInterface;
use App\Interfaces\MarketplaceRepositoryInterface;
use App\Repositories\HubRepository;
use App\Repositories\MocketplaceRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MarketplaceRepositoryInterface::class, MocketplaceRepository::class);
        $this->app->bind(HubRepositoryInterface::class, HubRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
