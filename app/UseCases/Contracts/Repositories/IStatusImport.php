<?php

namespace App\UseCases\Contracts\Repositories;

use App\Entities\Enums\CurrentStepStatusImport;
use App\Entities\StatusImport;

interface IStatusImport
{
    /**
     * Cria ou atualiza um status de importação
     * 
     * @param string $ref
     * @param CurrentStepStatusImport $currentStep
     * @return StatusImport|null
     */
    public function save(string $ref, CurrentStepStatusImport $currentStep): ?StatusImport;
}
