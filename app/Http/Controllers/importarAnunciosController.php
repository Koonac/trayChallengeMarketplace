<?php

namespace App\Http\Controllers;

use App\Jobs\ImportarAnunciosJob;
use Illuminate\Http\Request;

class ImportarAnunciosController extends Controller
{
    public function importarAnuncios(Request $request){

        try {
            $marketplace = $request->query('marketplace');
    
            if (!$marketplace) return response()->json(['error' => 'Parâmetro "marketplace" é obrigatório.'], 400);
    
            /* ADICIONADNO JOB */
            ImportarAnunciosJob::dispatch($marketplace);
    
            /* RESPOSTA API */
            return response()->json(
                [
                    'status' => true,
                    'message' => 'Importação agendada com sucesso. Marketplace: ' . $marketplace
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
