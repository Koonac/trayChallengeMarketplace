<?php

namespace App\UseCases;

use App\Jobs\ProcessOfferListJob;
use App\UseCases\Contracts\IImportOffer;

class ImportOffer implements IImportOffer
{

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        ProcessOfferListJob::dispatch();
    }
}
