<?php

namespace App\Http\Controllers;

use App\Jobs\ImportarAnunciosJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImportarAnunciosController extends Controller
{
    /**
     * Importa os anúncios de um marketplace.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function importarAnuncios(Request $request): JsonResponse
    {
        try {
            /* ADICIONADNO JOB */
            ImportarAnunciosJob::dispatch();

            /* RESPOSTA API */
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Importação agendada com sucesso.'
                ]
            );
        } catch (\Exception $e) {
            /* RESPOSTA API */
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }
}
