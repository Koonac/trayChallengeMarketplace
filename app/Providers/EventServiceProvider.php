<?php

namespace App\Providers;

use App\Events\OfferImported;
use App\Events\OfferProcessed;
use App\Events\OfferSended;
use App\Listeners\OnOfferImported;
use App\Listeners\OnOfferProcessed;
use App\Listeners\OnOfferSended;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    protected $listen = [
        OfferProcessed::class => [
            OnOfferProcessed::class,
        ],
        OfferImported::class => [
            OnOfferImported::class,
        ],
        OfferSended::class => [
            OnOfferSended::class,
        ],
    ];
}
