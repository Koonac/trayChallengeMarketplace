<?php

namespace App\Http\Controllers;

use App\Jobs\AnunciosJob;
use Illuminate\Http\Request;

class importarAnunciosController extends Controller
{
    public function importarAnuncios(Request $request){

        /* VALIDANDO PARÂMETROS */
        $json=$request->json();

        dd($json);

        $request->validate([
            'marketplace_id' => 'required|integer',
        ]);

        return response()->json(['status' => 'OK']);
    }
}
