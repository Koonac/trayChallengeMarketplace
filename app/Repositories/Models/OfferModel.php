<?php

namespace App\Repositories\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property string $reference
 * @property string $title
 * @property string $description
 * @property string $status
 * @property int    $stock
 * @property float  $price
 * @property array  $images
 * 
 */
class OfferModel extends Model
{
    protected $table = 'offers';

    protected $fillable = [
        'reference',
        'title',
        'description',
        'status',
        'stock',
        'price',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];
}
