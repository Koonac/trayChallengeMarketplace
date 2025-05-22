<?php

namespace App\UseCase\Contracts\Repositories;

use App\Entities\Offer;

interface IOfferRepository
{
    /**
     * Busca uma oferta pelo id
     *
     * @param string $ref
     * @return Offer|null
     */
    public function findByRef(string $ref): ?Offer;

    /**
     * Cria um oferta
     *
     * @param array $attributes
     * @return Offer
     */
    public function create(array $attributes): Offer;
}
