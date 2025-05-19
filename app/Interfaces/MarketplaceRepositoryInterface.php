<?php
namespace App\Interfaces;

interface MarketplaceRepositoryInterface
{
    public function getAnuncios(int $page): array;
    public function getInfoAnuncio(string $id): array;
    public function getImagensAnuncio(string $id): array;
    public function getPrecosAnuncio(string $id): array;
}