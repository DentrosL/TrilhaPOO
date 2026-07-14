<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Produto; // perceba que aqui estamos usando a classe Produto do namespace App\Models

$produto = new Produto();

$produto->exibir();