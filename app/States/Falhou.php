<?php
namespace App\States;

class Falhou extends StatusImportacao
{
    public function handle(): StatusImportacao
    {
        $this->statusImportacaoAnuncio->update(['status' => 'falhou']);
        logger("Status: 'Falhou' para {$this->statusImportacaoAnuncio->cod_anuncio}");

        return $this;
    }
}
