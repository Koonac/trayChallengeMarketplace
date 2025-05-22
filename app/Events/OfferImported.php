<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class OfferImported
{
    use Dispatchable;

    /**
     * O código de referência da oferta
     * 
     * @var string $ref
     */
    protected string $ref;

    /**
     * OfferImported constructor
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
