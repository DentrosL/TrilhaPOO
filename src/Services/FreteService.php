<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Encomenda;
use InvalidArgumentException;

class FreteService
{
    private const VALOR_KG = 2.50;
    private const VALOR_M3 = 50.00;
    private const TAXA_FIXA = 15.00;

    public function calcular(Encomenda $encomenda): float
    {
        if ($encomenda->getPeso() <= 0) {
            throw new InvalidArgumentException("O peso deve ser maior que zero.");
        }

        if ($encomenda->getVolume() <= 0) {
            throw new InvalidArgumentException("O volume deve ser maior que zero.");
        }

        if ($encomenda->getOrigem()->getId() === $encomenda->getDestino()->getId()) {
            throw new InvalidArgumentException("Origem e destino devem ser diferentes.");
        }

        $valor =
            self::TAXA_FIXA +
            ($encomenda->getPeso() * self::VALOR_KG) +
            ($encomenda->getVolume() * self::VALOR_M3);

        return round($valor, 2);
    }
}
