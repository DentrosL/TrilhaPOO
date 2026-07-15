<?php

namespace App\Models\Veiculos;

use App\Models\Veiculo;

class Van extends Veiculo
{
    public function __construct(
        string $placa,
        string $marca,
        string $modelo,
        string $cor,
        int $ano
    ) {
        parent::__construct($placa, $marca, $modelo, $cor, $ano);

        $this->capacidade_peso = 1500;
        $this->capacidade_volume = 12;
    }

    public function getTipo(): string
    {
        return 'Van';
    }
}