<?php

namespace App\UseCase\Offer;

use App\Entities\Offer;
use App\Events\OfferProcessed;
use App\UseCase\Contracts\Gateways\IOfferMarketplaceGateway;
use App\UseCase\Contracts\Offer\IOfferMarketplace;
use App\UseCase\Contracts\Repositories\IStatusImportRepository;
use App\UseCase\Contracts\StatusImport\IStatusImportParser;
use Illuminate\Support\Facades\Log;

class OfferMarketplace implements IOfferMarketplace
{
    /**
     * Gateway de anúncios do marketplace
     * 
     * @var IOfferMarketplaceGateway $offerMarketplaceGateway
     */
    protected IOfferMarketplaceGateway $offerMarketplaceGateway;

    /**
     * OfferMarketplace constructor
     * 
     * @param IOfferMarketplaceGateway $offerMarketplaceGateway
     */
    public function __construct(IOfferMarketplaceGateway $offerMarketplaceGateway)
    {
        $this->offerMarketplaceGateway =  $offerMarketplaceGateway;
    }

    /**
     * @inheritDoc
     */
    public function listOffersAndDispatch(): void
    {
        $page = 1;
        do {
            $offers = $this->offerMarketplaceGateway->all($page);

            if (!$offers) break;

            foreach ($offers as $offerReference) {
                $ref = $offerReference->reference;

                $statusImport = with(
                    app(IStatusImportRepository::class),
                    fn(IStatusImportRepository $statusImport) => $statusImport->save($ref)
                );

                with(
                    app(IStatusImportParser::class),
                    fn(IStatusImportParser $importParser) => $importParser->dispatchStatusEvent($statusImport->current_step, [$ref])
                );

                Log::info('[listOffersAndDispatch] Anúncio processado com sucesso', [
                    'reference' => $ref,
                    'current_step' => $statusImport->current_step
                ]);
            }

            $page++;
        } while (true);
    }

    /**
     * @inheritDoc
     */
    public function getOffer(string $ref): Offer
    {
        return $this->offerMarketplaceGateway->find($ref);
    }
}
