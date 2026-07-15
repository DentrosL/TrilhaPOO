<?php

namespace App\Models\Veiculos;

use App\Models\Veiculo;

class Van extends Veiculo
{
    public function __construct(
        string $placa,
        string $modelo,
        string $cor,
        int $ano
    ) {
        parent::__construct($placa, $modelo, $cor, $ano);

        $this->capacidadePeso = 1500;
        $this->capacidadeVolume = 12;
    }

    public function getTipo(): string
    {
        return 'Van';
    }
}