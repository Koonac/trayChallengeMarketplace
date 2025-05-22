<?php

namespace App\UseCases\Contracts\Gateways;

use App\Entities\Offer;
use App\Entities\OfferReference;
use Exception;

interface IOfferGateway
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
