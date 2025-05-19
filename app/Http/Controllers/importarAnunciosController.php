<?php

namespace App\Http\Controllers;

use App\Jobs\AnunciosJob;
use App\Jobs\ImportarAnunciosJob;
use Illuminate\Http\Request;

class importarAnunciosController extends Controller
{
    public function importarAnuncios(Request $request){

        /* VALIDANDO PARÂMETROS */
        $request->validate([
            'marketplace_id' => 'required|integer',
        ]);

        logger('request: ' .$request->input('marketplace_id'));

        ImportarAnunciosJob::dispatch($request->input('marketplace_id'));

        return response()->json(
            [
                'status' => true,
                'message' => 'Importação agendada com sucesso.'
            ]
        );
    }
}
