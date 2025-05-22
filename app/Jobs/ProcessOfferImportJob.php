<?php

namespace App\Jobs;

use App\UseCase\Contracts\Gateways\IOfferGateway;
use App\UseCase\Contracts\Offer\IOfferImporter;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessOfferImportJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * Código de referência da oferta
     * 
     * @var string $ref
     */
    protected string $ref;

    /**
     * Create a new job instance.
     */
    public function __construct(string $ref)
    {
        $this->ref = $ref;

        Log::withContext([
            'offer_id' => $this->ref,
            'action'   => 'process_offer_import_job',
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $offer = with(
                app(IOfferGateway::class),
                fn(IOfferGateway $gateway) => $gateway->find($this->ref)
            );

            with(
                app(IOfferImporter::class),
                fn(IOfferImporter $importer) => $importer->importAndDispatch($offer)
            );
        } catch (Exception $e) {
            Log::error('[ProcessOfferImportJob] Erro ao importar oferta. Ref #' . $this->ref, [
                'code'  => $e->getCode(),
                'error' => $e->getMessage(),
            ]);
        }
    }
}
