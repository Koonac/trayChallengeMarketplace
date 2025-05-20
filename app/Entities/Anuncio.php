<?php

namespace App\Entities;

/**
 * @property string $cod_anuncio
 * @property string $title
 * @property string $description
 * @property string $status
 * @property int $stock
 * @property Imagem[] $images
 * @property Preco[] $price
 *
 */
class Anuncio
{
    public function __construct(array $attributes = [])
    {
        $this->cod_anuncio  = $attributes['cod_anuncio'] ?? null;
        $this->title        = $attributes['title'] ?? null;
        $this->description  = $attributes['description'] ?? null;
        $this->status       = $attributes['status'] ?? null;
        $this->stock        = $attributes['stock'] ?? null;
        $this->images       = $attributes['images'] ?? null;
        $this->price        = $attributes['price'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'cod_anuncio'   => $this->cod_anuncio,
            'title'         => $this->title,
            'description'   => $this->description,
            'status'        => $this->status,
            'stock'         => $this->stock,
            'images'        => $this->images,
            'price'         => $this->price,
        ];
    }
}
