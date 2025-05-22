<?php

namespace App\Repositories\Models;

use App\Entities\Enums\CurrentStepStatusImport;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property string $reference
 *
 * @property value-of<CurrentStepStatusImport> $current_step
 */
class StatusImportModel extends Model
{
    protected $table = 'status_import';

    protected $fillable = [
        'reference',
        'current_step',
    ];
}
