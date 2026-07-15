<?php

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

        $this->capacidadePeso = 30000;
        $this->capacidadeVolume = 90;
    }
}