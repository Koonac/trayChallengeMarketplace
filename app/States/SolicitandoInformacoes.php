<?php
namespace App\States;

use App\Entities\Anuncio;
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
        $anuncio = new Anuncio([
            'title'         => $infoAnuncio['title'], 
            'description'   => $infoAnuncio['description'], 
            'status'        => $infoAnuncio['status'], 
            'stock'         => $infoAnuncio['stock'],
            'images'        => $imagensAnuncio,
            'price'         => $precosAnuncio,
        ]);

        /* SALVANDO PAYLOAD */
        $this->statusImportacaoAnuncio->update(['payload' => $anuncio]);

        return new EnviandoParaHub($this->statusImportacaoAnuncio, $this->marketplace, $this->hub);
    }
}
