<?php

namespace App\Listeners;

use App\Events\OfferImported;

class OnOfferImported
{
    /**
     * Executa quando um anúncio é importada
     *
     * @param OfferImported $event
     * @return void
     */
    public function handle(OfferImported $event): void
    {
        //
    }
}
