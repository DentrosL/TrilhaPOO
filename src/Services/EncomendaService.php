<?php

namespace App\Services;

use App\Models\Encomenda;
use App\Repositories\EncomendaRepository;
use InvalidArgumentException;
use RuntimeException;

class EncomendaService
{
    private EncomendaRepository $repository;

    public function __construct()
    {
        $this->repository = new EncomendaRepository();
    }

    public function cadastrar(Encomenda $encomenda): void
    {
        if (empty($encomenda->getCodigo())) {
            throw new InvalidArgumentException("O código da encomenda é obrigatório.");
        }

        if ($this->repository->buscarPorCodigo($encomenda->getCodigo())) {
            throw new RuntimeException("Já existe uma encomenda com este código.");
        }

        if (!$encomenda->getCliente()->getId()) {
            throw new InvalidArgumentException("Cliente inválido.");
        }

        if (!$encomenda->getOrigem()->getId()) {
            throw new InvalidArgumentException("Endereço de origem inválido.");
        }

        if (!$encomenda->getDestino()->getId()) {
            throw new InvalidArgumentException("Endereço de destino inválido.");
        }

        if (
            $encomenda->getOrigem()->getId() ===
            $encomenda->getDestino()->getId()
        ) {
            throw new InvalidArgumentException("Origem e destino devem ser diferentes.");
        }

        if ($encomenda->getPeso() <= 0) {
            throw new InvalidArgumentException("O peso deve ser maior que zero.");
        }

        if ($encomenda->getVolume() <= 0) {
            throw new InvalidArgumentException("O volume deve ser maior que zero.");
        }

        if ($encomenda->getValor() <= 0) {
            throw new InvalidArgumentException("O valor da encomenda deve ser maior que zero.");
        }

        $this->repository->criar($encomenda);
    }

    public function remover(int $id): void
    {
        if (!$this->repository->buscarPorId($id)) {
            throw new RuntimeException("Encomenda não encontrada.");
        }

        $this->repository->deletar($id);
    }

    public function buscarPorId(int $id): Encomenda
    {
        $encomenda = $this->repository->buscarPorId($id);

        if (!$encomenda) {
            throw new RuntimeException("Encomenda não encontrada.");
        }

        return $encomenda;
    }

    public function buscarPorCodigo(string $codigo): Encomenda
    {
        $encomenda = $this->repository->buscarPorCodigo($codigo);

        if (!$encomenda) {
            throw new RuntimeException("Encomenda não encontrada.");
        }

        return $encomenda;
    }

    public function listar(): array
    {
        return $this->repository->listar();
    }
}