<?php

namespace App\Gateways\Offer;

use App\Entities\Offer;
use App\Entities\OfferReference;
use App\UseCases\Contracts\Gateways\{IHttpClient, IOfferGateway};

use Exception;

class OfferGateway implements IOfferGateway
{
    /**
     * URL base para consulta de anúncios
     *
     * @var string $baseUrl
     */
    protected string $baseUrl = 'http://mockoon_server:3000';

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function all(int $page): ?array
    {
        $response = with(
            app(IHttpClient::class),
            fn(IHttpClient $client) => $client->get($this->baseUrl . '/offers?page=' . $page)
        );

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Something went wrong with external API', $response->getStatusCode());
        }

        $contents = json_decode($response->getBody()->getContents(), true);
        $offers = $contents['data']['offers'];

        $offersReference = empty($offers)
            ? null
            : array_map(fn(string $ref) => new OfferReference($ref), $offers);

        return $offersReference;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function find(string $ref): Offer
    {
        $details = $this->getDetails($ref);
        $images = $this->getImages($ref);
        $prices = $this->getPrices($ref);

        if (!$details) {
            throw new Exception('Offer not found. Ref: #' . $ref, 404);
        }

        return new Offer([
            'reference' => $ref,
            'title' => $details['title'],
            'description' => $details['description'],
            'status' => $details['status'],
            'stock' => $details['stock'],
            'price' => $prices['price'],
            'images' => $images,
        ]);
    }

    /**
     * Captura detalhes do anúncio pelo código de referência
     * 
     * @param string $ref
     * @return array|null
     * 
     * @throws Exception
     */
    private function getDetails(string $ref): array|null
    {
        $response = with(
            app(IHttpClient::class),
            fn(IHttpClient $client) => $client->get($this->baseUrl . '/offers/' . $ref)
        );

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Something went wrong with external API', $response->getStatusCode());
        }

        $contents = json_decode($response->getBody()->getContents(), true);
        $data = empty($contents['data']) ? null : $contents['data'];

        return $data;
    }

    /**
     * Captura imagens do anúncio pelo código de referência
     * 
     * @param string $ref
     * @return array|null
     * 
     * @throws Exception
     */
    private function getImages(string $ref): array|null
    {
        $response = with(
            app(IHttpClient::class),
            fn(IHttpClient $client) => $client->get($this->baseUrl . '/offers/' . $ref . '/images')
        );

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Something went wrong with external API', $response->getStatusCode());
        }

        $contents = json_decode($response->getBody()->getContents(), true);
        $data = empty($contents['data']['images']) ? null : $contents['data']['images'];

        return $data;
    }

    /**
     * Captura preços do anúncio pelo código de referência
     * 
     * @param string $ref
     * @return array|null
     * 
     * @throws Exception
     */
    private function getPrices(string $ref): array|null
    {
        $response = with(
            app(IHttpClient::class),
            fn(IHttpClient $client) => $client->get($this->baseUrl . '/offers/' . $ref . '/prices')
        );

        if ($response->getStatusCode() !== 200) {
            throw new Exception('Something went wrong with external API', $response->getStatusCode());
        }

        $contents = json_decode($response->getBody()->getContents(), true);
        $data = empty($contents['data']) ? null : $contents['data'];

        return $data;
    }
}
