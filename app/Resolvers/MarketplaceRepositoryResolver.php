<?php

namespace App\Resolvers;

use App\Interfaces\MarketplaceRepositoryInterface;
use App\Repositories\MocketplaceRepository;
use InvalidArgumentException;

class MarketplaceRepositoryResolver
{
    public static function resolve(string $idMarketplace): MarketplaceRepositoryInterface
    {
        return match ($idMarketplace) {
            'mocketplace' => app(MocketplaceRepository::class),
            // 'shopee' => app(ShopeeRepository::class),
            default => throw new InvalidArgumentException("Marketplace [$idMarketplace] não suportado."),
        };
    }
}
