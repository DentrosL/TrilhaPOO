<?php

class Pessoa
{
    protected string $nome;
    protected int $idade;

    public function __construct(string $nome, int $idade)
    {
        $this->nome = $nome;
        $this->idade = $idade;
    }

    public function apresentar(): void
    {
        echo "Meu nome é {$this->nome}.";
    }
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
}

// dessa forma, a classe Funcionario herda os métodos e propriedades da classe Pessoa, e podemos criar um objeto Funcionario com nome, idade e salário.
$funcionario = new Funcionario(
    "Ana",
    21,
    5500
);

$funcionario->apresentar();