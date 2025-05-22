<?php

namespace App\Jobs;

use App\UseCase\Contracts\Offer\IOfferSender;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessOfferSendHubJob implements ShouldQueue
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
            'action'   => 'process_offer_send_hub_job',
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            with(
                app(IOfferSender::class),
                fn(IOfferSender $sender) => $sender->sendToHub($this->ref)
            );
        } catch (Exception $e) {
            Log::error('[ProcessOfferSendHubJob] Erro ao enviar oferta para o hub. Ref #' . $this->ref, [
                'code'  => $e->getCode(),
                'error' => $e->getMessage(),
            ]);
        }
    }
}
