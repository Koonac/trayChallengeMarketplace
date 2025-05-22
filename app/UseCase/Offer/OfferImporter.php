<?php

namespace App\UseCase\Offer;

use App\Entities\Offer;
use App\UseCase\Contracts\Offer\IOfferFinder;
use App\UseCase\Contracts\Repositories\IOfferRepository;
use App\UseCase\Contracts\Offer\IOfferImporter;
use App\UseCase\Contracts\Repositories\IStatusImportRepository;
use App\UseCase\Contracts\StatusImport\IStatusImportParser;
use Illuminate\Support\Facades\Log;

class OfferImporter implements IOfferImporter
{
    /**
     * O repositório de ofertas
     *
     * @var IOfferRepository $repository
     */
    protected IOfferRepository $repository;

    /**
     * OfferImporter constructor
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
    public function importAndDispatch(Offer $offer): ?Offer
    {
        $offerCreated = with(
            app(IOfferFinder::class),
            fn(IOfferFinder $finder) => $finder->findByRef($offer->reference)
        );

        if (!$offerCreated) {
            $offerCreated = $this->repository->create($offer->toArray());
        }

        if (!$offerCreated) {
            Log::error('[importAndDispatch] Falha na importação', [
                'reason' => 'Oferta não importada.'
            ]);

            return null;
        }

        $statusImport = with(
            app(IStatusImportRepository::class),
            fn(IStatusImportRepository $statusImport) => $statusImport->transitionTo($offerCreated->reference, 'imported')
        );

        with(
            app(IStatusImportParser::class),
            fn(IStatusImportParser $importParser) => $importParser->dispatchStatusEvent($statusImport->current_step, [$offerCreated->reference])
        );

        Log::info('[importAndDispatch] Anúncio importado com sucesso', [
            'reference' => $offerCreated->reference,
            'current_step' => $statusImport->current_step
        ]);

        return $offerCreated;
    }
}
