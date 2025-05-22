<?php

namespace App\UseCase\Contracts\Offer;

use App\Entities\Offer;

interface IOfferParser
{

    /**
     * Converte a oferta para enviar ao hub
     * 
     * @param Offer $offer
     * @return array
     */
    public function toSendHub(Offer $offer): array;
}
