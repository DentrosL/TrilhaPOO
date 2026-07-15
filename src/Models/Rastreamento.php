<?php

namespace App\Models;

class Rastreamento
{
    private int $id = 0;
    private string $cidade;
    private string $descricao;
    private \DateTime $dataHora;

    public function __construct(string $cidade, string $descricao) {
        $this->cidade = $cidade;
        $this->descricao = $descricao;
        $this->dataHora = new \DateTime();
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getDataHora(): \DateTime
    {
        return $this->dataHora;
    }
}