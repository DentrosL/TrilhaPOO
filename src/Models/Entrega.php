<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeImmutable;

class Entrega
{
    private int $id = 0;
    private array $rastreamentos = [];

    public function __construct(
        private string $codigo,
        private Encomenda $encomenda,
        private Motorista $motorista,
        private Veiculo $veiculo,
        private string $status = 'Aguardando',
        private ?DateTimeImmutable $dataSaida = null,
        private ?DateTimeImmutable $dataPrevista = null,
        private ?DateTimeImmutable $dataEntrega = null
    ) {
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getCodigo(): string
    {
        return $this->codigo;
    }
    public function getEncomenda(): Encomenda
    {
        return $this->encomenda;
    }
    public function getMotorista(): Motorista
    {
        return $this->motorista;
    }
    public function getVeiculo(): Veiculo
    {
        return $this->veiculo;
    }
    public function getStatus(): string
    {
        return $this->status;
    }
    public function getDataSaida(): ?DateTimeImmutable
    {
        return $this->dataSaida;
    }
    public function getDataPrevista(): ?DateTimeImmutable
    {
        return $this->dataPrevista;
    }
    public function getDataEntrega(): ?DateTimeImmutable
    {
        return $this->dataEntrega;
    }
    public function atualizarStatus(string $status, ?DateTimeImmutable $dataEntrega = null): void
    {
        $this->status = $status;
        $this->dataEntrega = $dataEntrega;
    }
    public function adicionarRastreamento(Rastreamento $rastreamento): void
    {
        $this->rastreamentos[] = $rastreamento;
    }
    public function getRastreamentos(): array
    {
        return $this->rastreamentos;
    }
}
