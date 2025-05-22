<?php

namespace App\UseCases\Offer;

use App\Entities\Offer;
use App\Events\OfferProcessed;
use App\UseCases\Contracts\Gateways\IOfferGateway;
use App\UseCases\Contracts\Offer\IOfferMarketplace;
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
     * Offer constructor
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
    public function listOffers(): void
    {
        $page = 1;
        do {
            $offers = $this->offerGateway->all($page);

            if (!$offers) break;

            foreach ($offers as $offerReference) {
                /* 1. CRIAR REPOSITORY PARA status_import
                2. INSERIR/ATUALIZAR NO BANCO 
                3. DIPARAR EVENTO */
                $ref = $offerReference->reference;

                OfferProcessed::dispatch($ref);

                Log::info('Anúncio processado com sucesso', [
                    'reference' => $ref
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
        return new Offer();
    }
}
