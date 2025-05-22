<?php

namespace App\UseCase\Offer;

use App\Entities\Offer;
use App\UseCase\Contracts\Offer\IOfferParser;

class OfferParser implements IOfferParser
{

    /**
     * OfferParser constructor
     * 
     */
    public function __construct() {}

    /**
     * @inheritDoc
     */
    public function toSendHub(Offer $offer): array
    {
        return [
            'title'         => $offer->title,
            'description'   => $offer->description,
            'status'        => $offer->status,
            'stock'         => $offer->stock,
        ];
    }
}
