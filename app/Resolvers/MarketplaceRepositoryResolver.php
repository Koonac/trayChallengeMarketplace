<?php

namespace App\Resolvers;

use App\Interfaces\MarketplaceRepositoryInterface;
use App\Repositories\MocketplaceRepository;
use InvalidArgumentException;

/**
 * Retorna o repositório de um marketplace específico
 *
 * @param string $marketplace Nome do marketplace
 * @return MarketplaceRepositoryInterface Repositório do marketplace
 */
class MarketplaceRepositoryResolver
{
    public static function resolve(string $marketplace): MarketplaceRepositoryInterface
    {
        return match ($marketplace) {
            'mocketplace' => app(MocketplaceRepository::class),
            // 'shopee' => app(ShopeeRepository::class),
            default => throw new InvalidArgumentException("Marketplace [$marketplace] não suportado."),
        };
    }
}
