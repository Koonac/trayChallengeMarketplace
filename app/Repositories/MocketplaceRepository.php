<?php

namespace App\Repositories;

use App\Interfaces\MarketplaceRepositoryInterface;
use Illuminate\Support\Facades\Http;

class MocketplaceRepository implements MarketplaceRepositoryInterface
{
    private string $baseUrl;

    public function __construct()
    {
        /* CONFIGURA AQUI A URL DO MARKETPLACE */
        $this->baseUrl = 'http://mockoon_server:3000';
    }


    public function getAnuncios(int $page): array
    {
        $response = Http::get("{$this->baseUrl}/offers", ['page' => $page])->json();
        $retorno = [];

        /* TRATANDO RETORNO */
        if(count($response['data']['offers']) > 0) {
            foreach ($response['data']['offers'] as $codAnuncio) {
                $retorno[] = ['codAnuncio' => $codAnuncio];
            }
        }

        return $retorno;
    }

    public function getInfoAnuncio(string $id): array
    {
        $response = Http::get("{$this->baseUrl}/offers/{$id}")->json();

        /* TRATANDO RETORNO */
        $retorno = $response['data'];

        return $retorno;
    }

    public function getImagensAnuncio(string $id): array
    {
        $response = Http::get("{$this->baseUrl}/offers/{$id}/images")->json();

        /* TRATANDO RETORNO */
        $retorno = $response['data'];

        return $retorno;
    }

    public function getPrecosAnuncio(string $id): array
    {
        $response = Http::get("{$this->baseUrl}/offers/{$id}/prices")->json();
        
        /* TRATANDO RETORNO */
        $retorno = $response['data'];

        return $retorno;
    }
}
