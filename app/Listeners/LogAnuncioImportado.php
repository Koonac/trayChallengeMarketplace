<?php

namespace App\Listeners;

use App\Events\AnuncioImportado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogAnuncioImportado
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AnuncioImportado $event): void
    {
        $codAnuncio = $event->codAnuncio;

        Log::info("Anúncio #{$codAnuncio} importado e enviado ao HUB.\n\n");
    }
}
