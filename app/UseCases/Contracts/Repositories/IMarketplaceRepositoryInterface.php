<?php

namespace App\UseCases\Contracts\Repositories;

use App\Entities\Anuncio;
use App\Entities\Imagem;
use App\Entities\Preco;

interface IMarketplaceRepositoryInterface
{
    /**
     * Captura a lista de anúncios
     *
     * @param int $page
     * @return array|null
     */
    public function getAnuncios(int $page): ?array;

    /**
     * Captura informações do anúncio
     *
     * @param int $id
     * @return Anuncio|null
     */
    public function getInfoAnuncio(string $id): ?Anuncio;

    /**
     * Captura a lista de imagens de um anúncio
     *
     * @param int $id
     * @return Imagem|null
     */
    public function getImagensAnuncio(string $id): ?Imagem;

    /**
     * Captura o preço de um anúncio
     *
     * @param int $id
     * @return Preco|null
     */
    public function getPrecosAnuncio(string $id): ?Preco;
}
