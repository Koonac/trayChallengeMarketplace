<?php

namespace App\UseCases\Contracts\Repositories;

use App\Entities\Anuncio;

interface IHubRepositoryInterface
{
    /**
     * Envia o anúncio para o hub
     *
     * @param int $id
     * @return void
     */
    public function enviarAnuncio(Anuncio $anuncio): void;
}
