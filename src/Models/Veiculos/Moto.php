<?php

declare(strict_types=1);

namespace App\Models\Veiculos;

use App\Models\Veiculo;

class Moto extends Veiculo
{
    public function __construct(string $placa, string $modelo, string $cor, int $ano)
    {
        parent::__construct($placa, $modelo, $cor, $ano);

        $this->capacidade_peso = 35;
        $this->capacidade_volume = 0.18;
    }

    public function getTipo(): string
    {
        return 'Moto';
    }
}
