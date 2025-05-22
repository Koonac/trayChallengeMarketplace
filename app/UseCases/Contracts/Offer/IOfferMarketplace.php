<?php

namespace App\UseCases\Contracts\Offer;

use App\Entities\Offer;
use App\Entities\OfferReference;

interface IOfferMarketplace
{

    /**
     * Lista todas as ofertas do marketplace
     * 
     * @return void
     */
    public function listOffers(): void;

    /**
     * Busca um anúncio no marketplace
     * 
     * @param string $ref
     * @return Offer
     */
    public function getOffer(string $ref): Offer;
}
