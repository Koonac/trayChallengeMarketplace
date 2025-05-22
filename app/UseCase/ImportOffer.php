<?php

namespace App\UseCase;

use App\Jobs\ProcessOfferListJob;
use App\UseCase\Contracts\IImportOffer;
use Illuminate\Support\Facades\Log;

class ImportOffer implements IImportOffer
{

    /**
     * @inheritDoc
     */
    public function execute(): void
    {
        Log::info('[ImportOffer] Iniciando importação...');

        ProcessOfferListJob::dispatch();
    }
}
