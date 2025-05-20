<?php

namespace App\Jobs;

use App\UseCases\Anuncio\ImportarAnuncios;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ImportarAnunciosJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct() {}

    public function handle(ImportarAnuncios $importarAnuncios): void
    {
        try {
            Log::info('[ImportarAnunciosJob] Iniciando importação...');

            $importarAnuncios->executar();

            Log::info('[ImportarAnunciosJob] Importação finalizada com sucesso.');
        } catch (\Exception $e) {
            Log::error('[ImportarAnunciosJob] Falha na importação: ' . $e->getMessage());
        }
    }
}
