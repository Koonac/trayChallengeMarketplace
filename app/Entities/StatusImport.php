<?php

namespace App\Entities;

use App\Entities\Enums\CurrentStepStatusImport;

/**
 * @property int    $id
 * @property string $reference
 *
 * @property value-of<CurrentStepStatusImport> $current_step
 */
class StatusImport
{
    function __construct(array $attributes = [])
    {
        $this->id             = $attributes['id']             ?? null;
        $this->reference      = $attributes['reference']      ?? null;
        $this->current_step   = $attributes['current_step']   ?? null;
    }

    public function toArray(): array
    {
        return [
            'id'            => $this->id,
            'reference'     => $this->reference,
            'current_step'  => $this->current_step,
        ];
    }
}
