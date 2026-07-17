<?php

declare(strict_types=1);

namespace App\Models\Veiculos;

use App\Models\Veiculo;

class Caminhao extends Veiculo
{
    public function __construct(
        string $placa,
        string $modelo,
        string $cor,
        int $ano
    ) {
        parent::__construct($placa, $modelo, $cor, $ano);

        $this->capacidade_peso = 30000;
        $this->capacidade_volume = 90;
    }

    public function getTipo(): string
    {
        return 'Caminhão';
    }
}
