<?php
namespace App\UseCases;

use App\Interfaces\HubRepositoryInterface;
use App\Interfaces\MarketplaceRepositoryInterface;
use App\Models\StatusImportacaoAnuncio;
use App\States\Concluido;
use App\States\EnviandoParaHub;
use App\States\Falhou;
use App\States\ImportacaoPendente;
use App\States\SolicitandoInformacoes;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Regras de negócio para importação de anúncios do marketplace para o hub.
 *
 */
class ImportarAnunciosUseCase
{
    private MarketplaceRepositoryInterface $marketplaceRepo;
    private HubRepositoryInterface $hubRepo;

    public function __construct(
        MarketplaceRepositoryInterface $marketplaceRepo,
        HubRepositoryInterface $hubRepo
    ) {
        $this->marketplaceRepo = $marketplaceRepo;
        $this->hubRepo = $hubRepo;
    }

    /**
     * Executa as regras de negócio.
     * 
     * @return void
     */
    public function executar(): void
    {
        $page = 1;
        $iteraLaco = true;
        $listStatusImportacao = [
            'importacao_pendente'        => ImportacaoPendente::class,
            'solicitando_informacoes'    => SolicitandoInformacoes::class,
            'enviando_para_hub'          => EnviandoParaHub::class,
        ];

        while($iteraLaco){
            /* CAPTURANDO ANÚNCIOS */
            $anuncios = $this->marketplaceRepo->getAnuncios($page);

            if(count($anuncios) > 0){
                foreach ($anuncios as $anuncio) {
                    try {
                        $codAnuncio = $anuncio['codAnuncio'];

                        /* CAPTURANDO STATUS DE IMPORTAÇÃO */
                        $importacaoAnuncio = StatusImportacaoAnuncio::firstOrCreate([
                            'cod_anuncio' => $codAnuncio
                        ], [
                            'marketplace_name' => 'mocketplace',
                            'status' => 'importacao_pendente'
                        ]);

                        /* CAPTURANDO A CLASSE DE IMPORTAÇÃO ATUAL */
                        $statusImportacaoClass = $listStatusImportacao[$importacaoAnuncio->status] ?? Concluido::class;

                        /* CHAMANDO INSTÂNCIANDO A CLASSE DE STATUS DE IMPORTAÇÃO */
                        $status = new $statusImportacaoClass($importacaoAnuncio, $this->marketplaceRepo, $this->hubRepo);

                        /* PERCORRENDO CADA STATUS ATÉ SER 'CONCLUIDO' */
                        while (($importacaoAnuncio->status != 'concluido') && ($importacaoAnuncio->status != 'falhou')) {
                            $status = $status->handle();
                        }

                    }catch(\Exception $e){
                        $iteraLaco = false;
                        $statusFalhou = new Falhou($importacaoAnuncio, $this->marketplaceRepo, $this->hubRepo);
                        $statusFalhou->handle();
                        Log::error('[ImportarAnunciosUseCase] Erro ao importar anúncio: ' . $e->getMessage());
                    }
                }
            }else{
                $iteraLaco = false;
            }

            /* INCREMENTANDO VARIAVEL */
            $page++;
        }
    }
}
