<?php

namespace App\Models;

use DateTime;

class Rastreamento
{
    private int $id = 0;
    private string $cidade;
    private string $descricao;
    private DateTime $data_hora;

    public function __construct(string $cidade, string $descricao, DateTime $data_hora) {
        $this->cidade = $cidade;
        $this->descricao = $descricao;
        $this->data_hora = $data_hora;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
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
        return $this->data_hora;
    }
}