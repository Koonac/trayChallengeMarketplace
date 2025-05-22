<?php

namespace App\Repositories;

use App\Entities\StatusImport;
use App\Repositories\Models\StatusImportModel;
use App\UseCase\Contracts\Repositories\IStatusImportRepository;

class StatusImportRepository implements IStatusImportRepository
{
    /**
     * O modelo do status de importação
     *
     * @var StatusImportModel|null $model
     */
    protected ?StatusImportModel $model = null;

    /**
     * @inheritDoc
     */
    public function findByRef(string $ref): ?StatusImport
    {
        $statusImport = $this->getModel()->where('reference', $ref)->first();
        if (!$statusImport) {
            return null;
        }

        return $this->toEntity($statusImport);
    }

    /**
     * @inheritDoc
     */
    public function save(string $ref): StatusImport
    {
        $statusImport = $this->getModel()->where('reference', $ref)->first();
        if (!$statusImport) {
            $statusImport = $this->getModel()->create([
                'reference' => $ref,
                'current_step' => 'processing',
            ]);
        }
        return $this->toEntity($statusImport);
    }

    /**
     * @inheritDoc
     */
    public function transitionTo(string $ref, string $step): ?StatusImport
    {
        $statusImport = $this->getModel()->where('reference', $ref)->first();
        if (!$statusImport) {
            return null;
        }

        $statusImport->update(['current_step' => $step]);
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
