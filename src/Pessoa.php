<?php

class Pessoa
{
    private string $nome;

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }

    // método público para acessar a propriedade privada $nome
    public function getNome(): string
    {
        return $this->nome;
    }
}

$pessoa = new Pessoa("Aliceti");

// não vai funcionar, pois estamos tentando acessar a propriedade privada $nome diretamente
// echo $pessoa->nome;

// dessa forma funciona, pois estamos chamando o método público getNome():
echo $pessoa->getNome();