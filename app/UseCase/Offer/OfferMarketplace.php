<?php

namespace App\UseCase\Offer;

use App\Entities\Offer;
use App\Events\OfferProcessed;
use App\UseCase\Contracts\Gateways\IOfferGateway;
use App\UseCase\Contracts\Offer\IOfferMarketplace;
use App\UseCase\Contracts\Repositories\IStatusImportRepository;
use App\UseCase\Contracts\StatusImport\IStatusImportParser;
use Illuminate\Support\Facades\Log;

class OfferMarketplace implements IOfferMarketplace
{
    /**
     * Gateway de anúncios do marketplace
     * 
     * @var IOfferGateway $offerGateway
     */
    protected IOfferGateway $offerGateway;

    /**
     * OfferMarketplace constructor
     * 
     * @param IOfferGateway $offerGateway
     */
    public function __construct(IOfferGateway $offerGateway)
    {
        $this->offerGateway =  $offerGateway;
    }

    /**
     * @inheritDoc
     */
    public function listOffersAndDispatch(): void
    {
        $page = 1;
        do {
            $offers = $this->offerGateway->all($page);

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

                Log::info('[listOffersAndDispatch]Anúncio processado com sucesso', [
                    'reference' => $ref,
                    'status_import' => $statusImport
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
        return $this->offerGateway->find($ref);
    }
}
