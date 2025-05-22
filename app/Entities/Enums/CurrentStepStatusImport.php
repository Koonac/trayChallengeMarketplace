<?php

namespace App\Entities\Enums;

enum CurrentStepStatusImport: string
{
    case PROCESSING     = 'processing';
    case IMPORTED       = 'imported';
    case COMPLETED      = 'completed';
    case FAILED         = 'failed';
}
