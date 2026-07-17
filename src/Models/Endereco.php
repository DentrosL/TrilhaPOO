<?php

declare(strict_types=1);

namespace App\Models;

class Endereco
{
    private int $id = 0;

    public function __construct(
        private Cliente $cliente,
        private string $rua,
        private string $numero,
        private string $bairro,
        private string $cidade,
        private string $estado,
        private string $cep,
        private string $tipo
    ) {
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getCliente(): Cliente
    {
        return $this->cliente;
    }
    public function getRua(): string
    {
        return $this->rua;
    }
    public function getNumero(): string
    {
        return $this->numero;
    }
    public function getBairro(): string
    {
        return $this->bairro;
    }
    public function getCidade(): string
    {
        return $this->cidade;
    }
    public function getEstado(): string
    {
        return $this->estado;
    }
    public function getCep(): string
    {
        return $this->cep;
    }
    public function getTipo(): string
    {
        return $this->tipo;
    }
}
