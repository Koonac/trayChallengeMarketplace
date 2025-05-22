<?php

namespace App\UseCase\Contracts\Offer;

interface IOfferSender
{

    /**
     * Envia o anúncio para o Hub
     * 
     * @param string $ref
     * @return void
     */
    public function sendToHub(string $ref): void;
}
