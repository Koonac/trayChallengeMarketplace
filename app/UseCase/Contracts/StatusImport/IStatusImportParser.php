<?php

namespace App\UseCase\Contracts\StatusImport;


interface IStatusImportParser
{
    /**
     * Dispara um evento baseado no status atual
     * 
     * @param string $currentStep
     * @param array $params
     * @return void
     */
    public function dispatchStatusEvent(string $currentStep, array $params): void;
}
