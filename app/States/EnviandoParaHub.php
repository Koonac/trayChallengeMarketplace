<?php
namespace App\States;

class EnviandoParaHub extends StatusImportacao
{
    public function handle(): StatusImportacao
    {
        $this->statusImportacaoAnuncio->update(['status' => 'enviando_para_hub']);
        logger("Novo status 'EnviandoParaHub' para o anúncio #{$this->statusImportacaoAnuncio->cod_anuncio}");

        $payload = $this->statusImportacaoAnuncio->payload;

        /* ENVIANDO PAYLOAD PARA O HUB */
        $this->hub->enviarAnuncio([
            'title'         => $payload['title'],
            'description'   => $payload['description'],
            'status'        => $payload['status'],
            'stock'         => $payload['stock'],
        ]);

        return new Concluido($this->statusImportacaoAnuncio, $this->marketplace, $this->hub);

    }
}
