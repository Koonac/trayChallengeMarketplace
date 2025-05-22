<?php

namespace App\UseCase\Offer;

use App\UseCase\Contracts\Gateways\IOfferHubGateway;
use App\UseCase\Contracts\Offer\IOfferFinder;
use App\UseCase\Contracts\Offer\IOfferParser;
use App\UseCase\Contracts\Offer\IOfferSender;
use App\UseCase\Contracts\Repositories\IStatusImportRepository;
use App\UseCase\Contracts\StatusImport\IStatusImportParser;
use Illuminate\Support\Facades\Log;

class OfferSender implements IOfferSender
{

    /**
     * Gateway de anúncios do hub
     * 
     * @var IOfferHubGateway $offerHubGateway
     */
    protected IOfferHubGateway $offerHubGateway;

    /**
     * Offer constructor
     * 
     * @param IOfferHubGateway $offerHubGateway
     */
    public function __construct(IOfferHubGateway $offerHubGateway)
    {
        $this->offerHubGateway =  $offerHubGateway;
    }

    /**
     * @inheritDoc
     */
    public function sendToHub(string $ref): void
    {
        $offer = with(
            app(IOfferFinder::class),
            fn(IOfferFinder $finder) => $finder->findByRef($ref)
        );

        if (!$offer) {
            Log::error('[sendToHub] Falha no envio para o hub', [
                'reason' => 'Anúncio não encontrado.'
            ]);

            return;
        }

        $payload = with(
            app(IOfferParser::class),
            fn(IOfferParser $parser) => $parser->toSendHub($offer)
        );

        $this->offerHubGateway->send($payload);

        $statusImport = with(
            app(IStatusImportRepository::class),
            fn(IStatusImportRepository $statusImport) => $statusImport->transitionTo($offer->reference, 'completed')
        );

        Log::info('[sendToHub] Anúncio enviado ao hub com sucesso.', [
            'reference' => $ref,
            'current_step' => $statusImport->current_step
        ]);
    }
}
