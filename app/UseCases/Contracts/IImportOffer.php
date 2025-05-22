<?php

namespace App\UseCases\Contracts;

interface IImportOffer
{
    /**
     * Executa o processo de importação de anúncios
     * 
     * @return void
     */
    public function execute(): void;
}
