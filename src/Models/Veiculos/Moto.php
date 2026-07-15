<?php

namespace App\Models\Veiculos;

use App\Models\Veiculo;

class Moto extends Veiculo
{
    public function __construct(
        string $placa,
        string $modelo,
        string $cor,
        int $ano
    ) {
        parent::__construct($placa, $modelo, $cor, $ano);

        $this->capacidadePeso = 35;
        $this->capacidadeVolume = 0.18;
    }
}