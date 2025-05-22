<?php

namespace App\UseCase\Contracts\Offer;

use App\Entities\Offer;

interface IOfferImporter
{

    /**
     * Importa um anúncio
     * 
     * @param Offer $offer
     * @return Offe|null
     */
    public function importAndDispatch(Offer $offer): ?Offer;
}
