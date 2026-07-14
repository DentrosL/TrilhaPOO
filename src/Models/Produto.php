<?php

namespace App\Models;

class Produto
{
    public function __construct(
        public string $nome,
        public float $preco
    ) {
    }
}