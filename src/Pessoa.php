<?php

abstract class Pessoa
{
    protected string $nome;
    protected int $idade;

    public function __construct(string $nome, int $idade)
    {
        $this->nome = $nome;
        $this->idade = $idade;
    }

    abstract function apresentar(): void;
}

class Funcionario extends Pessoa
{
    protected float $salario;

    public function __construct(
        string $nome,
        int $idade,
        float $salario
    ) {
        parent::__construct($nome, $idade);

        $this->salario = $salario;
    }

    public function apresentar(): void
    {
        echo "Olá! Meu nome é {$this->nome} e sou funcionário.";
    }
}

class Cliente extends Pessoa
{
    protected float $cpf_cnpj;

    public function __construct(
        string $nome,
        int $idade,
        float $cpf_cnpj
    ) {
        parent::__construct($nome, $idade);

        $this->cpf_cnpj = $cpf_cnpj;
    }

    public function apresentar(): void
    {
        echo "Olá! Meu nome é {$this->nome} e sou cliente.";
    }
}
$cliente = new Cliente("Maria", 30, 12345678901);
$funcionario = new Funcionario("João", 28, 5000);

$cliente->apresentar();
$funcionario->apresentar();