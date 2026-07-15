<?php

namespace App\Models;

class Entrega
{
    private string $codigo;
    private Encomenda $encomenda;
    private Motorista $motorista;
    private Veiculo $veiculo;
    private array $rastreamentos = [];

    public function __construct(string $codigo, Encomenda $encomenda, Motorista $motorista, Veiculo $veiculo)
    {
        $this->codigo = $codigo;
        $this->encomenda = $encomenda;
        $this->motorista = $motorista;
        $this->veiculo = $veiculo;
    }

    public function getEncomenda(): Encomenda
    {
        return $this->encomenda;
    }

    public function getMotorista(): Motorista
    {
        return $this->motorista;
    }

    public function getVeiculo(): Veiculo
    {
        return $this->veiculo;
    }

    public function adicionarRastreamento(Rastreamento $rastreamento): void
    {
        $this->rastreamentos[] = $rastreamento;
    }

    public function getRastreamentos(): array
    {
        return $this->rastreamentos;
    }
}