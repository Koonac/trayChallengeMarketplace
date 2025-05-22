<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class OfferProcessed
{
    use Dispatchable;

    /**
     * O código de referência da oferta
     * 
     * @var string $ref
     */
    protected string $ref;

    /**
     * OfferProcessed constructor
     * 
     * @param string $ref
     */
    public function __construct(string $ref)
    {
        $this->ref = $ref;
    }

    /**
     * Retorna o código de referência da oferta
     * 
     * @param string $ref
     */
    public function getOfferRef(): string
    {
        return $this->ref;
    }
}
