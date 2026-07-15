<?php

namespace App\Models;

abstract class Veiculo
{
    private string $placa;
    private string $modelo;
    private string $cor;
    private int $ano;
    protected float $capacidadePeso;
    protected float $capacidadeVolume;

    public function __construct(string $placa, string $modelo, string $cor, int $ano)
    {
        $this->placa = $placa;
        $this->modelo = $modelo;
        $this->cor = $cor;
        $this->ano = $ano;
    }

    public function getPlaca(): string
    {
        return $this->placa;
    }

    public function getModelo(): string
    {
        return $this->modelo;
    }

    public function getCor(): string
    {
        return $this->cor;
    }

    public function getAno(): int
    {
        return $this->ano;
    }

    public function getCapacidadePeso(): float
    {
        return $this->capacidadePeso;
    }

    public function getCapacidadeVolume(): float
    {
        return $this->capacidadeVolume;
    }

    abstract public function getTipo(): string;
}