<?php

namespace App\UseCase\Contracts\Offer;

use App\Entities\Offer;

interface IOfferFinder
{
    /**
     * Busca uma oferta importada pelo código de referência
     *
     * @param string $ref
     * @return Offer|null
     */
    public function findByRef(string $ref): ?Offer;
}
