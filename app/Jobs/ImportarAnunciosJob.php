<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;

class ImportarAnunciosJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    protected $marketplaceId;

    /**
     * Create a new job instance.
     */
    public function __construct($marketplaceId)
    {
        $this->marketplaceId = $marketplaceId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logger('Job: ' .$this->marketplaceId);
    }


}
