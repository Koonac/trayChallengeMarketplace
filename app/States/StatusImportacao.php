<?php

namespace App\States;

use App\Repositories\Models\StatusImportacaoAnuncio;
use App\UseCases\Contracts\Repositories\IHubRepositoryInterface;
use App\UseCases\Contracts\Repositories\IMarketplaceRepositoryInterface;

abstract class StatusImportacao
{

    public function __construct(
        protected StatusImportacaoAnuncio $statusImportacaoAnuncio,
        protected IMarketplaceRepositoryInterface $marketplace,
        protected IHubRepositoryInterface $hub,
    ) {}

    abstract public function handle(): StatusImportacao;
}
