<?php

namespace App\UseCase\Contracts\Gateways;

use App\Entities\Offer;
use App\Entities\OfferReference;
use Exception;

interface IOfferMarketplaceGateway
{

    /**
     * Retornar uma lista de anúncios
     * 
     * @param int $page
     * @return OfferReference[]|null
     */
    public function all(int $page): ?array;

    /**
     * Retornar uma lista de anúncios
     * 
     * @param int $page
     * @return Offer
     */
    public function find(string $ref): Offer;
}
