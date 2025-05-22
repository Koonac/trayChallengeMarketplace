<?php

namespace App\UseCase\Contracts;

interface IImportOffer
{
    /**
     * Executa o processo de importação de anúncios
     * 
     * @return void
     */
    public function execute(): void;
}
