<?php

namespace App\Repositories;

use App\Entities\Anuncio;
use App\Entities\Imagem;
use App\Entities\Preco;
use App\UseCases\Contracts\Repositories\IMarketplaceRepositoryInterface;
use Illuminate\Support\Facades\Http;

/**
 * Repositório de anúncios para o 'Mocketplace'.
 *
 * Implementa a interface de comunicação com o 'Mocketplace'.
 */
class MarketplaceRepository implements IMarketplaceRepositoryInterface
{
    private string $baseUrl;

    public function __construct()
    {
        /* CONFIGURA AQUI A URL DO MARKETPLACE */
        $this->baseUrl = 'http://mockoon_server:3000';
    }

    /**
     * Retorna a lista de anúncios
     *
     * @param int $page Página para listar os anúncios
     * @return array Lista de anúncios
     */
    public function getAnuncios(int $page): array
    {
        $response = Http::get("{$this->baseUrl}/offers", ['page' => $page])->json();
        $retorno = [];

        /* TRATANDO RETORNO */
        if (count($response['data']['offers']) > 0) {
            foreach ($response['data']['offers'] as $codAnuncio) {
                $retorno[] = ['codAnuncio' => $codAnuncio];
            }
        }

        return $retorno;
    }

    /**
     * Captura informações do anúncios
     *
     * @param string $id Código do anúncio
     * @return Anuncio InformaçÕes do anúncio
     */
    public function getInfoAnuncio(string $id): Anuncio
    {
        $response = Http::get("{$this->baseUrl}/offers/{$id}")->json();

        /* TRATANDO RETORNO */
        $retorno = $response['data'];

        return $retorno;
    }

    /**
     * Captura imagens do anúncios
     *
     * @param string $id Código do anúncio
     * @return array Urls de imagens do anúncio
     */
    public function getImagensAnuncio(string $id): Imagem
    {
        $response = Http::get("{$this->baseUrl}/offers/{$id}/images")->json();

        /* TRATANDO RETORNO */
        $retorno = $response['data'];

        return $retorno;
    }

    /**
     * Captura preços do anúncios
     *
     * @param string $id Código do anúncio
     * @return array Preços do anúncio
     */
    public function getPrecosAnuncio(string $id): Preco
    {
        $response = Http::get("{$this->baseUrl}/offers/{$id}/prices")->json();

        /* TRATANDO RETORNO */
        $retorno = $response['data'];

        return $retorno;
    }
}
