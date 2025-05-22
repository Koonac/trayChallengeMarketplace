<?php

namespace App\UseCase\Offer;

use App\Entities\Offer;
use App\UseCase\Contracts\Gateways\IOfferGateway;
use App\UseCase\Contracts\Offer\IOfferSender;

class OfferSender implements IOfferSender
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
    public function sendToHub(Offer $offer): void {}
}
