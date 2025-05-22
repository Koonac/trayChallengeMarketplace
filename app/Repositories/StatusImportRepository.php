<?php

namespace App\Repositories;

use App\Entities\Enums\CurrentStepStatusImport;
use App\Entities\StatusImport;
use App\Repositories\Models\StatusImportModel;
use App\UseCases\Contracts\Repositories\IStatusImport;

class StatusImportRepository implements IStatusImport
{
    /**
     * O modelo do status de importação
     *
     * @var StatusImportModel|null $model
     */
    protected ?StatusImportModel $model = null;

    /**
     * Retorna o model
     *
     * @return StatusImportModel
     */
    public function save(string $ref, CurrentStepStatusImport $currentStep): StatusImport
    {
        $statusImport = $this->getModel()->where('reference', $ref)->first();
        if (!$statusImport) {
            $statusImport = $this->getModel()->create([
                'reference' => $ref,
                'current_step' => $currentStep,
            ]);
        }
        return $this->toEntity($statusImport);
    }

    /**
     * Retorna o model
     *
     * @return StatusImportModel
     */
    protected function getModel(): StatusImportModel
    {
        if (is_null($this->model)) {
            $this->model = app(StatusImportModel::class);
        }

        return $this->model;
    }

    /**
     * Transforma model em entidade
     *
     * @param StatusImportModel $model
     * @return StatusImport
     */
    protected function toEntity(StatusImportModel $model): StatusImport
    {
        return new StatusImport($model->toArray());
    }
}
