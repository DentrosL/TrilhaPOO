<?php

class Pessoa
{
    // atributos
    public string $nome;
    public int $idade;
    public string $sexo;
    public float $altura;
    public float $peso;
}

// criando um objeto
$pessoa = new Pessoa();

// armazenando valores nos atributos do objeto
$pessoa->nome = "José";
$pessoa->idade = 21;
$pessoa->sexo = "Masculino";
$pessoa->altura = 1.75;
$pessoa->peso = 70.0;