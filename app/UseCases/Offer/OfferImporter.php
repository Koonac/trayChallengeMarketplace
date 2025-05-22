<?php

namespace App\UseCases\Offer;

use App\Entities\Offer;
use App\UseCases\Contracts\Gateways\IOfferGateway;
use App\UseCases\Contracts\Offer\IOfferImporter;

class OfferImporter implements IOfferImporter
{
    /**
     * Offer constructor
     * 
     * @param IOfferGateway $offerGateway
     */
    public function __construct(IOfferGateway $offerGateway) {}

    /**
     * @inheritDoc
     */
    public function import(Offer $offer): void {}
}
