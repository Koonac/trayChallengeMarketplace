<?php

namespace App\Entities\Enums;

enum StatusImportacaoAnuncio: string
{
    case IMPORTACAO_PENDENTE = 'importacao_pendente';
    case SOLICITANDO_INFORMACOES = 'solicitando_informacoes';
    case ENVIANDO_PARA_HUB = 'enviando_para_hub';
    case CONCLUIDO = 'concluido';
    case FALHOU = 'falhou';
}
