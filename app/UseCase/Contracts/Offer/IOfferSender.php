<?php

namespace App\UseCase\Contracts\Offer;

use App\Entities\Offer;

interface IOfferSender
{

    /**
     * Envia o anúncio para o Hub
     * 
     * @param Offer $offer
     * @return void
     */
    public function sendToHub(Offer $offer): void;
}
