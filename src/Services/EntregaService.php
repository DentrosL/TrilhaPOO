<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\StatusEntrega;
use App\Exceptions\EntregaFinalizadaException;
use App\Exceptions\MotoristaIndisponivelException;
use App\Exceptions\VeiculoSemCapacidadeException;
use App\Models\Entrega;
use App\Repositories\EntregaRepository;
use DateTimeImmutable;
use InvalidArgumentException;
use RuntimeException;

class EntregaService
{
    public function __construct(private EntregaRepository $repository = new EntregaRepository())
    {
    }
    public function criar(Entrega $entrega): bool
    {
        if ($entrega->getEncomenda()->getId() <= 0 || $entrega->getMotorista()->getId() <= 0 || $entrega->getVeiculo()->getId() <= 0) {
            throw new InvalidArgumentException('Dados da entrega são inválidos.');
        }
        if (!$entrega->getMotorista()->isDisponivel()) {
            throw new MotoristaIndisponivelException('Motorista indisponível.');
        }
        if ($entrega->getEncomenda()->getPeso() > $entrega->getVeiculo()->getCapacidadePeso() || $entrega->getEncomenda()->getVolume() > $entrega->getVeiculo()->getCapacidadeVolume()) {
            throw new VeiculoSemCapacidadeException('Veículo sem capacidade para a encomenda.');
        }
        return $this->repository->criar($entrega);
    }
    public function atualizarStatus(int $id, string $status): bool
    {
        $entrega = $this->buscarPorId($id);
        if ($entrega->getStatus() === StatusEntrega::ENTREGUE->value) {
            throw new EntregaFinalizadaException('A entrega já foi finalizada.');
        }
        if (!in_array($status, StatusEntrega::valores(), true)) {
            throw new InvalidArgumentException('Status de entrega inválido.');
        }
        return $this->repository->atualizarStatus($id, $status, $status === StatusEntrega::ENTREGUE->value ? new DateTimeImmutable() : null);
    }
    public function deletar(int $id): bool
    {
        $this->buscarPorId($id);
        return $this->repository->deletar($id);
    }
    public function listar(): array
    {
        return $this->repository->listar();
    }
    public function buscarPorId(int $id): Entrega
    {
        $entrega = $this->repository->buscarPorId($id);
        if (!$entrega) {
            throw new RuntimeException('Entrega não encontrada.');
        } return $entrega;
    }
}
