<?php

namespace App\Repositories;

use App\Entities\Anuncio;
use App\UseCases\Contracts\Repositories\IHubRepositoryInterface;
use Illuminate\Support\Facades\Http;

/**
 * Repositório de hub para o 'Hub'.
 *
 * Implementa a interface de comunicação com o 'Hub'.
 */
class HubRepository implements IHubRepositoryInterface
{
    private string $baseUrl;

    public function __construct()
    {
        /* CONFIGURA AQUI A URL DO HUB */
        $this->baseUrl = 'http://mockoon_server:3000';
    }

    /**
     * Cadastra o anúncio no hub
     *
     * @param Anuncio $anuncio anúncio para envio
     * @return void
     */
    public function enviarAnuncio(Anuncio $anuncio): void
    {
        Http::post("{$this->baseUrl}/hub/create-offer", $anuncio);
    }
}
