<?php

class Pessoa
{
    // atributos
    public string $nome;
    
    // construtor
    public function __construct(string $nome){
        $this->nome = $nome;
        echo "Objeto criado!";
    }
}
// não chamamos o método manualmente.ele é executado sozinho.
// agora da pra criar um objeto já com o nome definido no construtor.
$pessoa = new Pessoa("Elisa");