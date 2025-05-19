<?php
namespace App\States;

class SolicitandoInformacoes extends StatusImportacao
{
    public function handle(): StatusImportacao
    {
        $codAnuncio = $this->statusImportacaoAnuncio->cod_anuncio;
        $this->statusImportacaoAnuncio->update(['status' => 'solicitando_informacoes']);
        logger("Novo status 'SolicitandoInformacoes' para o anúncio #{$codAnuncio}");

        $infoAnuncio    = $this->marketplace->getInfoAnuncio($codAnuncio);
        $imagensAnuncio = $this->marketplace->getImagensAnuncio($codAnuncio);
        $precosAnuncio  = $this->marketplace->getPrecosAnuncio($codAnuncio);

        /* MONTANDO PAYLOAD */
        $payload = [
            'title'         => $infoAnuncio['title'], 
            'description'   => $infoAnuncio['description'], 
            'status'        => $infoAnuncio['status'], 
            'stock'         => $infoAnuncio['stock'],
            'images'        => $imagensAnuncio['images'],
            'price'         => $precosAnuncio['price'],
        ];

    
        /* SALVANDO PAYLOAD */
        $this->statusImportacaoAnuncio->update(['payload' => $payload]);

        return new EnviandoParaHub($this->statusImportacaoAnuncio, $this->marketplace, $this->hub);
    }
}
