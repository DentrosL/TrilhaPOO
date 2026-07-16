<?php

namespace App\Enums;

class StatusEntrega
{
    public const AGUARDANDO = 'Aguardando';
    public const EM_PREPARACAO = 'Em preparação';
    public const EM_TRANSITO = 'Em trânsito';
    public const SAIU_PARA_ENTREGA = 'Saiu para entrega';
    public const ENTREGUE = 'Entregue';
    public const CANCELADA = 'Cancelada';
}