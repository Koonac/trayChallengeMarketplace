<?php

namespace App\Providers;

use App\Entities\StatusImport;
use App\Gateways\Client\GuzzleHttpClient;
use App\Gateways\Offer\OfferGateway;
use App\UseCases\Contracts\Gateways\IHttpClient;
use App\UseCases\Contracts\Gateways\IOfferGateway;
use App\UseCases\Contracts\IImportOffer;
use App\UseCases\Contracts\Offer\IOfferImporter;
use App\UseCases\Contracts\Offer\IOfferMarketplace;
use App\UseCases\Contracts\Offer\IOfferSender;
use App\UseCases\Contracts\Repositories\IStatusImport;
use App\UseCases\ImportOffer;
use App\UseCases\Offer\OfferImporter;
use App\UseCases\Offer\OfferMarketplace;
use App\UseCases\Offer\OfferSender;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindClient();
        $this->bindOffer();
        $this->bindStatusImport();

        $this->app->bind(IImportOffer::class, ImportOffer::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    protected function bindOffer(): void
    {
        $this->app->bind(IOfferGateway::class, OfferGateway::class);
        $this->app->bind(IOfferMarketplace::class, OfferMarketplace::class);
        $this->app->bind(IOfferImporter::class, OfferImporter::class);
        $this->app->bind(IOfferSender::class, OfferSender::class);
    }

    protected function bindStatusImport(): void
    {
        $this->app->bind(IStatusImport::class, StatusImport::class);
    }

    protected function bindClient(): void
    {
        $this->app->bind(IHttpClient::class, GuzzleHttpClient::class);
    }
}
