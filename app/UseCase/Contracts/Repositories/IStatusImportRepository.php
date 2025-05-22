<?php

namespace App\UseCase\Contracts\Repositories;

use App\Entities\StatusImport;

interface IStatusImportRepository
{
    /**
     * Captura um status de importação pelo código de referência
     * 
     * @param string $ref
     * @return StatusImport|null
     */
    public function findByRef(string $ref): ?StatusImport;

    /**
     * Cria ou atualiza um status de importação
     * 
     * @param string $ref
     * @return StatusImport|null
     */
    public function save(string $ref): ?StatusImport;

    /**
     * Altera etapa do status de importação
     * 
     * @param string $ref
     * @param string $step
     * @return StatusImport|null
     */
    public function transitionTo(string $ref, string $step): ?StatusImport;
}
