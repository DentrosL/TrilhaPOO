<?php

class Usuario
{
    use Logger;
}

$usuario = new Usuario();
$usuario->registrarLog(); // utiliza o método do trait Logger

// reutilizando em outra classe
class Produto
{
    use Logger;
}

$produto = new Produto();
$produto->registrarLog();