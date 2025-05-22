<?php

namespace App\Listeners;

use App\Events\OfferSended;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OnOfferSended
{
    /**
     * Executa quando uma oferta é enviada para o hub
     *
     * @param OfferSended $event
     * @return void
     */
    public function handle(OfferSended $event): void
    {
        //
    }
}
