<?php

namespace App\Jobs;

use App\UseCases\Contracts\Offer\IOfferMarketplace;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessOfferListJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        Log::withContext([
            'action'     => 'process_offer_list_job',
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            with(
                app(IOfferMarketplace::class),
                fn(IOfferMarketplace $marketplace) => $marketplace->listOffers()
            );
        } catch (Exception $e) {
            Log::error('[ProcessOfferListJob] Erro ao listar ofertas.', [
                'code'  => $e->getCode(),
                'error' => $e->getMessage(),
            ]);
        }
    }
}
