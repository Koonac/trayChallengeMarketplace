<?php

namespace App\Listeners;

use App\Events\OfferProcessed;

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
        //
    }
}
