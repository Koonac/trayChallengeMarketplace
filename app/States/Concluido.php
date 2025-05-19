<?php
namespace App\States;

use App\Events\AnuncioImportado;

class Concluido extends StatusImportacao
{
    public function handle(): StatusImportacao
    {
        $codAnuncio = $this->statusImportacaoAnuncio->cod_anuncio;

        $this->statusImportacaoAnuncio->update(['status' => 'concluido']);
        logger("Novo status 'Concluido' para o anúncio #{$codAnuncio}");

        /* DISPARANDO EVENTO DE ANÚNCIO IMPORTADO */
        event(new AnuncioImportado($codAnuncio));

        return $this;
    }
}
