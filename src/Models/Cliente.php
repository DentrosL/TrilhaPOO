<?php

namespace App\Models;

class Cliente
{
    private string $nome;
    private string $email;
    private string $telefone;
    private string $cpf;
    private int $id = 0;
    private array $enderecos = [];

    public function __construct(string $nome,string $email,string $telefone,string $cpf)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->cpf = $cpf;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEnderecos(): array
    {
        return $this->enderecos;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function adicionarEndereco(Endereco $endereco): void
    {   
        $this->enderecos[] = $endereco;
    }
}