<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

class StatusImportacaoAnuncio extends Model
{
    protected $table = 'status_importacao_anuncios';

    protected $fillable = ['cod_anuncio', 'marketplace_name', 'status', 'payload'];

    protected $casts = [
        'payload' => 'array',
    ];
}
