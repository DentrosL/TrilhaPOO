<?php

namespace App\Models;

class Veiculo
{
    private int $id;
    private string $placa;
    private string $marca;
    private string $modelo;
    private string $cor;
    private int $ano;
    protected float $capacidade_peso;
    protected float $capacidade_volume;

    public function __construct(string $placa, string $marca, string $modelo, string $cor, int $ano)
    {
        $this->placa = $placa;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->cor = $cor;
        $this->ano = $ano;
    }
    
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPlaca(): string
    {
        return $this->placa;
    }

    public function getMarca(): string
    {
        return $this->marca;
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
        return $this->capacidade_peso;
    }

    public function getCapacidadeVolume(): float
    {
        return $this->capacidade_volume;
    }

    public function getTipo(): string
    {
        return 'Veículo';
    }
}