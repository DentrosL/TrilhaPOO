<?php

namespace App\Services;

use App\Models\Rastreamento;
use App\Repositories\EntregaRepository;
use App\Repositories\RastreamentoRepository;
use InvalidArgumentException;
use RuntimeException;

class RastreamentoService
{
    private RastreamentoRepository $repository;
    private EntregaRepository $entregaRepository;

    public function __construct()
    {
        $this->repository = new RastreamentoRepository();
        $this->entregaRepository = new EntregaRepository();
    }

    public function cadastrar(Rastreamento $rastreamento, int $entregaId): void
    {
        if (!$this->entregaRepository->buscarPorId($entregaId)) {
            throw new RuntimeException("Entrega não encontrada.");
        }

        if (empty(trim($rastreamento->getCidade()))) {
            throw new InvalidArgumentException("A cidade é obrigatória.");
        }

        if (empty(trim($rastreamento->getDescricao()))) {
            throw new InvalidArgumentException("A descrição é obrigatória.");
        }

        if (!$rastreamento->getDataHora()) {
            throw new InvalidArgumentException("A data e hora são obrigatórias.");
        }

        $this->repository->criar($rastreamento, $entregaId);
    }

    public function remover(int $id): void
    {
        if (!$this->repository->buscarPorId($id)) {
            throw new RuntimeException("Rastreamento não encontrado.");
        }

        $this->repository->deletar($id);
    }

    public function buscarPorId(int $id): Rastreamento
    {
        $rastreamento = $this->repository->buscarPorId($id);

        if (!$rastreamento) {
            throw new RuntimeException("Rastreamento não encontrado.");
        }

        return $rastreamento;
    }

    public function listar(): array
    {
        return $this->repository->listar();
    }

    public function listarPorEntrega(int $entregaId): array
    {
        if (!$this->entregaRepository->buscarPorId($entregaId)) {
            throw new RuntimeException("Entrega não encontrada.");
        }

        return $this->repository->listarPorEntrega($entregaId);
    }
}