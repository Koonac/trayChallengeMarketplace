<?php
namespace App\Interfaces;

interface HubRepositoryInterface
{
    public function enviarAnuncio(array $payload): void;
}