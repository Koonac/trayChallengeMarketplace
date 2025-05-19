<?php

namespace App\Providers;

use App\Events\AnuncioImportado;
use App\Listeners\LogAnuncioImportado;
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
        AnuncioImportado::class => [
            LogAnuncioImportado::class,
        ],
    ];
}
