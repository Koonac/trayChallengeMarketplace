<?php
namespace App\States;

class ImportacaoPendente extends StatusImportacao
{
    public function handle(): StatusImportacao
    {
        $this->statusImportacaoAnuncio->update(['status' => 'importacao_pendente']);
        logger("Novo status 'ImportacaoPendente' para o anúncio #{$this->statusImportacaoAnuncio->cod_anuncio}");

        return new SolicitandoInformacoes($this->statusImportacaoAnuncio, $this->marketplace, $this->hub);
    }
}
