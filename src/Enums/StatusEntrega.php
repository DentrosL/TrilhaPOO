<?php

declare(strict_types=1);

namespace App\Enums;

enum StatusEntrega: string
{
    case AGUARDANDO = 'Aguardando';
    case EM_PREPARACAO = 'Em preparação';
    case EM_TRANSITO = 'Em trânsito';
    case SAIU_PARA_ENTREGA = 'Saiu para entrega';
    case ENTREGUE = 'Entregue';
    case CANCELADA = 'Cancelada';

    public static function valores(): array
    {
        return array_map(static fn (self $status): string => $status->value, self::cases());
    }
}
