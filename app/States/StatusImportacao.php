<?php
namespace App\States;

use App\Interfaces\HubRepositoryInterface;
use App\Interfaces\MarketplaceRepositoryInterface;
use App\Models\StatusImportacaoAnuncio;

abstract class StatusImportacao
{

    public function __construct(
        protected StatusImportacaoAnuncio $statusImportacaoAnuncio,
        protected MarketplaceRepositoryInterface $marketplace,
        protected HubRepositoryInterface $hub,
    ){}

    abstract public function handle(): StatusImportacao;
}
