<?php

namespace App\Repositories;

use App\Entities\Offer;
use App\Repositories\Models\OfferModel;
use App\UseCase\Contracts\Repositories\IOfferRepository;

class OfferRepository implements IOfferRepository
{
    /**
     * O modelo de oferta
     *
     * @var OfferModel|null $model
     */
    protected ?OfferModel $model = null;

    /**
     * Encontra uma oferta por id
     *
     * @param string $ref
     * @return Offer|null
     */
    public function findByRef(string $ref): ?Offer
    {
        $offer = $this->getModel()->where('reference', $ref)->first();
        if (!$offer) {
            return null;
        }

        return $this->toEntity($offer);
    }

    /**
     * Cria uma oferta
     *
     * @param array $attributes
     * @return Offer
     */
    public function create(array $attributes): Offer
    {
        $offer = $this->getModel()->create($attributes);

        return $this->toEntity($offer);
    }

    /**
     * Retorna o model
     *
     * @return OfferModel
     */
    protected function getModel(): OfferModel
    {
        if (is_null($this->model)) {
            $this->model = app(OfferModel::class);
        }

        return $this->model;
    }

    /**
     * Transforma model em entidade
     *
     * @param OfferModel $model
     * @return Offer
     */
    protected function toEntity(OfferModel $model): Offer
    {
        return new Offer($model->toArray());
    }
}
