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
            'processing'   => OfferProcessed::dispatch(...$params),
            'imported'     => OfferImported::dispatch(...$params),
            'sended'       => OfferSended::dispatch(...$params),
            default        => throw new InvalidArgumentException("Status inválido: {$currentStep}"),
        };
    }

    /**
     * @inheritDoc
     */
    public function nextStep(string $step): string
    {
        return match ($step) {
            'processing'   => 'imported',
            'imported'     => 'sended',
            'sended'       => 'completed',
            default        => throw new InvalidArgumentException("Status inválido: {$step}"),
        };
    }
}
