<?php

declare(strict_types=1);

namespace App\Models;

class Motorista
{
    private string $nome;
    private string $cnh;
    private string $cpf;
    private string $categoria;
    private bool $disponivel;
    private array $encomendas = [];
    private int $id = 0;

    public function __construct(string $nome, string $cnh, string $cpf, string $categoria)
    {
        $this->nome = $nome;
        $this->cnh = $cnh;
        $this->cpf = $cpf;
        $this->categoria = $categoria;
        $this->disponivel = true;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setDisponivel(bool $disponivel): void
    {
        $this->disponivel = $disponivel;
    }

    public function getEncomendas(): array
    {
        return $this->encomendas;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCnh(): string
    {
        return $this->cnh;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }

    public function isDisponivel(): bool
    {
        return $this->disponivel;
    }

    public function adicionarEncomenda(Encomenda $encomenda): void
    {
        $this->encomendas[] = $encomenda;
    }
}
