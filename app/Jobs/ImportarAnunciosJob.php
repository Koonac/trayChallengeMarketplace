<?php

namespace App\Jobs;

use App\Interfaces\HubRepositoryInterface;
use App\Resolvers\MarketplaceRepositoryResolver;
use App\UseCases\ImportarAnunciosUseCase;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ImportarAnunciosJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(private string $marketplace)
    {
    }

    public function handle(HubRepositoryInterface $hubRepo): void
    {
        try {
            /* ESCOLHENDO O MARKETPLACE REPOSITORY */
            $marketplaceRepo = MarketplaceRepositoryResolver::resolve($this->marketplace);

            Log::info('[ImportarAnunciosJob] Iniciando importação...');

            $useCase = new ImportarAnunciosUseCase($marketplaceRepo, $hubRepo);
            $useCase->executar();

            Log::info('[ImportarAnunciosJob] Importação finalizada com sucesso.');

        } catch (\Exception $e) {
            Log::error('[ImportarAnunciosJob] Falha na importação: ' . $e->getMessage());
        }
    }

}
