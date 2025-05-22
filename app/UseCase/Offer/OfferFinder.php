<?php

namespace App\UseCase\Offer;

use App\Entities\Offer;
use App\UseCase\Contracts\Offer\IOfferFinder;
use App\UseCase\Contracts\Repositories\IOfferRepository;

class OfferFinder implements IOfferFinder
{
    /**
     * O repositório de ofertas
     *
     * @var IOfferRepository $repository
     */
    protected IOfferRepository $repository;

    /**
     * OfferFinder's constructor
     *
     * @param IOfferRepository $repository
     */
    public function __construct(IOfferRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function findByRef(string $ref): ?Offer
    {
        return $this->repository->findByRef($ref);
    }
}
