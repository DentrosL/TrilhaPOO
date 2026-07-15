<?php

namespace App\Models;

class Encomenda
{
    private string $codigo;
    private Cliente $cliente;
    private float $peso;
    private float $volume;
    private Endereco $origem;
    private Endereco $destino;
    private float $valor;
    private int $id = 0;

    public function __construct(string $codigo, Cliente $cliente, float $peso, float $volume, Endereco $origem, Endereco $destino, float $valor)
    {
        $this->codigo = $codigo;
        $this->cliente = $cliente;
        $this->peso = $peso;
        $this->volume = $volume;
        $this->origem = $origem;
        $this->destino = $destino;
        $this->valor = $valor;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function getCliente(): Cliente
    {
        return $this->cliente;
    }

    public function getPeso(): float
    {
        return $this->peso;
    }

    public function getVolume(): float
    {
        return $this->volume;
    }

    public function getOrigem(): Endereco
    {
        return $this->origem;
    }

    public function getDestino(): Endereco
    {
        return $this->destino;
    }

    public function getValor(): float
    {
        return $this->valor;
    }
}