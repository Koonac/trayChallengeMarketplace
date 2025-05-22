<?php

namespace App\Http\Controllers;

use App\UseCase\Contracts\IImportOffer;
use Illuminate\Http\JsonResponse;

class ImportOffersController extends Controller
{
    /**
     * Importa os anúncios de um marketplace.
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        with(
            app(IImportOffer::class),
            fn(IImportOffer $importOffer) => $importOffer->execute()
        );

        /* RESPOSTA API */
        return response()->json(
            [
                'status' => true,
                'message' => 'Importação agendada com sucesso.'
            ]
        );
    }
}
