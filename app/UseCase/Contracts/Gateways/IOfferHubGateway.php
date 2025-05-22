<?php

namespace App\UseCase\Contracts\Gateways;

use Exception;

interface IOfferHubGateway
{

    /**
     * Envia um payload
     * 
     * @param array $payload
     * @return array|null
     */
    public function send(array $payload): ?array;
}
