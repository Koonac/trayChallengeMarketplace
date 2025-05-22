<?php

namespace App\Listeners;

use App\Events\OfferImported;
use App\Jobs\ProcessOfferSendHubJob;
use Illuminate\Log\Logger;

class OnOfferImported
{
    /**
     * Executa quando um anúncio é importado
     *
     * @param OfferImported $event
     * @return void
     */
    public function handle(OfferImported $event): void
    {
        $ref = $event->getOfferRef();

        Logger('Hora de criar o job para enviarrr', ['ref' => $ref]);

        // ProcessOfferSendHubJob::dispatch($ref);
    }
}
