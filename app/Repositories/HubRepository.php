<?php

namespace App\Repositories;

use App\Interfaces\HubRepositoryInterface;
use Illuminate\Support\Facades\Http;
/**
 * Repositório de hub para o 'Hub'.
 *
 * Implementa a interface de comunicação com o 'Hub'.
 */
class HubRepository implements HubRepositoryInterface
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
     * @param array $payload Payload de envio
     * @return void
     */
    public function enviarAnuncio(array $payload): void
    {
        Http::post("{$this->baseUrl}/hub/create-offer", $payload);
    }
}
