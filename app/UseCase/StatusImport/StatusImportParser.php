<?php

namespace App\UseCase\StatusImport;

use App\Events\OfferImported;
use App\Events\OfferProcessed;
use App\Events\OfferSended;
use App\UseCase\Contracts\StatusImport\IStatusImportParser;
use InvalidArgumentException;

class StatusImportParser implements IStatusImportParser
{

    /**
     * @inheritDoc
     */
    public function dispatchStatusEvent($currentStep, $params): void
    {
        match ($currentStep) {
            'processing'    => OfferProcessed::dispatch(...$params),
            'imported'      => OfferImported::dispatch(...$params),
            'completed'     => null,
            'failed'        => null,
            default         => throw new InvalidArgumentException("Status inválido: {$currentStep}"),
        };
    }
}
