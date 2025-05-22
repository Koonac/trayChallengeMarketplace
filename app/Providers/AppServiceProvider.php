<?php

namespace App\Providers;

use App\Gateways\Client\GuzzleHttpClient;
use App\Gateways\Hub\OfferHubGateway;
use App\Gateways\Marketplace\OfferMarketplaceGateway;
use App\Repositories\OfferRepository;
use App\Repositories\StatusImportRepository;
use App\UseCase\Contracts\Gateways\IHttpClient;
use App\UseCase\Contracts\Gateways\IOfferHubGateway;
use App\UseCase\Contracts\Gateways\IOfferMarketplaceGateway;
use App\UseCase\Contracts\IImportOffer;
use App\UseCase\Contracts\Offer\IOfferFinder;
use App\UseCase\Contracts\Offer\IOfferImporter;
use App\UseCase\Contracts\Offer\IOfferMarketplace;
use App\UseCase\Contracts\Offer\IOfferParser;
use App\UseCase\Contracts\Offer\IOfferSender;
use App\UseCase\Contracts\Repositories\IOfferRepository;
use App\UseCase\Contracts\Repositories\IStatusImportRepository;
use App\UseCase\Contracts\StatusImport\IStatusImportParser;
use App\UseCase\ImportOffer;
use App\UseCase\Offer\OfferFinder;
use App\UseCase\Offer\OfferImporter;
use App\UseCase\Offer\OfferMarketplace;
use App\UseCase\Offer\OfferParser;
use App\UseCase\Offer\OfferSender;
use App\UseCase\StatusImport\StatusImportParser;
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
        $this->app->bind(IOfferMarketplaceGateway::class, OfferMarketplaceGateway::class);
        $this->app->bind(IOfferHubGateway::class, OfferHubGateway::class);
        $this->app->bind(IOfferMarketplace::class, OfferMarketplace::class);
        $this->app->bind(IOfferImporter::class, OfferImporter::class);
        $this->app->bind(IOfferSender::class, OfferSender::class);
        $this->app->bind(IOfferParser::class, OfferParser::class);
        $this->app->bind(IOfferRepository::class, OfferRepository::class);
        $this->app->bind(IOfferFinder::class, OfferFinder::class);
    }

    protected function bindStatusImport(): void
    {
        $this->app->bind(IStatusImportRepository::class, StatusImportRepository::class);
        $this->app->bind(IStatusImportParser::class, StatusImportParser::class);
    }

    protected function bindClient(): void
    {
        $this->app->bind(IHttpClient::class, GuzzleHttpClient::class);
    }
}
