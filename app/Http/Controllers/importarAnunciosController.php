<?php

namespace App\Http\Controllers;

use App\Jobs\ImportarAnunciosJob;
use Illuminate\Http\Request;

class ImportarAnunciosController extends Controller
{
    public function importarAnuncios(Request $request){

        /* ADICIONADNO JOB */
        ImportarAnunciosJob::dispatch();

        /* RESPOSTA API */
        return response()->json(
            [
                'status' => true,
                'message' => 'Importação agendada com sucesso.'
            ]
        );
    }
}
