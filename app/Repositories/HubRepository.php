<?php

namespace App\Repositories;

use App\Interfaces\HubRepositoryInterface;
use Illuminate\Support\Facades\Http;

class HubRepository implements HubRepositoryInterface
{
    private string $baseUrl;

    public function __construct()
    {
        /* CONFIGURA AQUI A URL DO HUB */
        $this->baseUrl = 'http://mockoon_server:3000';
    }

    public function enviarAnuncio(array $payload): void
    {
        Http::post("{$this->baseUrl}/hub/create-offer", $payload);
    }
}
