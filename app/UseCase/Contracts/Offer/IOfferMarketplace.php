<?php

namespace App\UseCase\Contracts\Offer;

use App\Entities\Offer;

interface IOfferMarketplace
{

    /**
     * Lista todas as ofertas do marketplace
     * 
     * @return void
     */
    public function listOffersAndDispatch(): void;

    /**
     * Busca um anúncio no marketplace
     * 
     * @param string $ref
     * @return Offer
     */
    public function getOffer(string $ref): Offer;
}
