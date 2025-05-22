<?php

namespace App\Entities;

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
class Offer
{
    function __construct(array $attributes = [])
    {
        $this->id             = $attributes['id']             ?? null;
        $this->reference      = $attributes['reference']      ?? null;
        $this->title          = $attributes['title']          ?? null;
        $this->description    = $attributes['description']    ?? null;
        $this->status         = $attributes['status']         ?? null;
        $this->stock          = $attributes['stock']          ?? null;
        $this->price          = $attributes['price']          ?? null;
        $this->images         = $attributes['images']         ?? null;
    }

    public function toHub(): array
    {
        return [
            'title'         => $this->title,
            'description'   => $this->description,
            'status'        => $this->status,
            'quantity'      => $this->stock,
        ];
    }
}
