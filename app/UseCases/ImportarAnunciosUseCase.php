<?php
namespace App\UseCases;

use App\Events\AnuncioImportado;
use App\Interfaces\HubRepositoryInterface;
use App\Interfaces\MarketplaceRepositoryInterface;
use Illuminate\Support\Facades\Log;

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

    public function executar(): void
    {
        $page = 1;
        $iteraLaco = true;

        while($iteraLaco){
            /* CAPTURANDO ANÚNCIOS */
            $anuncios = $this->marketplaceRepo->getAnuncios($page);

            if(count($anuncios) > 0){
                foreach ($anuncios as $anuncio) {
                    try {
                        $codAnuncio     = $anuncio['codAnuncio'];
                        $infoAnuncio    = $this->marketplaceRepo->getInfoAnuncio($codAnuncio);
                        $imagensAnuncio = $this->marketplaceRepo->getImagensAnuncio($codAnuncio);
                        $precosAnuncio  = $this->marketplaceRepo->getPrecosAnuncio($codAnuncio);

                        /* MONTANDO PAYLOAD */
                        $payload = [
                            'title'         => $infoAnuncio['title'], 
                            'description'   => $infoAnuncio['description'], 
                            'status'        => $infoAnuncio['status'], 
                            'stock'         => $infoAnuncio['stock'],
                            // 'images'        => $imagensAnuncio['images'],
                            // 'price'         => $precosAnuncio['price'],
                        ];

                        $this->hubRepo->enviarAnuncio($payload);

                        event(new AnuncioImportado($codAnuncio));
                        
                    }catch(\Exception $e){
                        $iteraLaco = false;
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
