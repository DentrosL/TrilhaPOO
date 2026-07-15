<?php

namespace App\Models;

class Endereco
{
    private int $id = 0;
    private Cliente $cliente;
    private string $rua;
    private string $numero;
    private string $bairro;
    private string $cidade;
    private string $estado;
    private string $cep;
    private string $tipo; // residencial, comercial, entrega, cobrança, etc.

    public function __construct(string $rua, string $numero, string $bairro, string $cidade, string $estado, string $cep, string $tipo)
    {
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;
        $this->tipo = $tipo;
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