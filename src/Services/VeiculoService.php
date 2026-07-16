<?php

namespace App\Services;

use App\Models\Veiculo;
use App\Repositories\VeiculoRepository;
use InvalidArgumentException;
use RuntimeException;

class VeiculoService
{
    private VeiculoRepository $repository;

    public function __construct()
    {
        $this->repository = new VeiculoRepository();
    }

    public function cadastrar(Veiculo $veiculo): void
    {
        if (empty($veiculo->getPlaca())) {
            throw new InvalidArgumentException("A placa é obrigatória.");
        }

        if (empty($veiculo->getModelo())) {
            throw new InvalidArgumentException("O modelo é obrigatório.");
        }

        if ($veiculo->getAno() < 1900) {
            throw new InvalidArgumentException("Ano do veículo inválido.");
        }

        if ($veiculo->getCapacidadePeso() <= 0) {
            throw new InvalidArgumentException("Capacidade de peso inválida.");
        }

        if ($veiculo->getCapacidadeVolume() <= 0) {
            throw new InvalidArgumentException("Capacidade de volume inválida.");
        }

        $this->repository->criar($veiculo);
    }

    public function remover(int $id): void
    {
        $veiculo = $this->repository->buscarPorId($id);

        if (!$veiculo) {
            throw new RuntimeException("Veículo não encontrado.");
        }

        $this->repository->deletar($id);
    }

    public function buscarPorId(int $id): Veiculo
    {
        $veiculo = $this->repository->buscarPorId($id);

        if (!$veiculo) {
            throw new RuntimeException("Veículo não encontrado.");
        }

        return $veiculo;
    }

    public function listar(): array
    {
        return $this->repository->listar();
    }
}