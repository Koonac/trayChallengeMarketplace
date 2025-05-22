<?php

namespace App\Gateways\Hub;

use App\UseCase\Contracts\Gateways\{IHttpClient, IOfferHubGateway};

use Exception;

class OfferHubGateway implements IOfferHubGateway
{
    /**
     * URL base para o hub
     *
     * @var string $baseUrl
     */
    protected string $baseUrl = 'http://mockoon_server:3000';

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function send(array $payload): ?array
    {
        $response = with(
            app(IHttpClient::class),
            fn(IHttpClient $client) => $client->post($this->baseUrl . '/hub/create-offer', [
                'json' => $payload
            ])
        );

        if ($response->getStatusCode() !== 201) {
            throw new Exception('Something went wrong with external API', $response->getStatusCode());
        }

        $contents = json_decode($response->getBody()->getContents(), true);

        return $contents;
    }
}
