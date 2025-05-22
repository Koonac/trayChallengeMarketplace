<?php

namespace App\UseCases\Contracts\Offer;

use App\Entities\Offer;

interface IOfferImporter
{

    /**
     * Importa anúncio
     * 
     * @param Offer $offer
     * @return void
     */
    public function import(Offer $offer): void;

}
