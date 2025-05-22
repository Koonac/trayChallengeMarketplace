<?php

namespace App\Listeners;

use App\Events\OfferProcessed;
use App\Jobs\ProcessOfferImportJob;

class OnOfferProcessed
{
    /**
     * Executa quando uma oferta é processada
     *
     * @param OfferProcessed $event
     * @return void
     */
    public function handle(OfferProcessed $event): void
    {
        $ref = $event->getOfferRef();

        ProcessOfferImportJob::dispatch($ref);
    }
}
