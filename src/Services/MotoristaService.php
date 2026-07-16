<?php

namespace App\Services;

use App\Models\Motorista;
use App\Repositories\MotoristaRepository;
use InvalidArgumentException;
use RuntimeException;

class MotoristaService
{
    public function __construct(
        private MotoristaRepository $repository = new MotoristaRepository()
    ) {
    }

    public function criar(Motorista $motorista): bool
    {
        $this->validar($motorista);

        if ($this->repository->buscarPorCpf($motorista->getCpf())) {
            throw new RuntimeException('Já existe um motorista com este CPF.');
        }

        if ($this->repository->buscarPorCnh($motorista->getCnh())) {
            throw new RuntimeException('Já existe um motorista com esta CNH.');
        }

        return $this->repository->criar($motorista);
    }

    public function deletar(int $id): bool
    {
        if (!$this->repository->buscarPorId($id)) {
            throw new RuntimeException('Motorista não encontrado.');
        }

        return $this->repository->deletar($id);
    }

    public function listar(): array
    {
        return $this->repository->listar();
    }

    public function buscarPorId(int $id): ?Motorista
    {
        return $this->repository->buscarPorId($id);
    }

    private function validar(Motorista $motorista): void
    {
        if (trim($motorista->getNome()) === '') {
            throw new InvalidArgumentException('Nome é obrigatório.');
        }

        if (!preg_match('/^\d{11}$/', preg_replace('/\D/', '', $motorista->getCpf()))) {
            throw new InvalidArgumentException('CPF inválido.');
        }

        if (trim($motorista->getCnh()) === '') {
            throw new InvalidArgumentException('CNH é obrigatória.');
        }

        if (trim($motorista->getCategoria()) === '') {
            throw new InvalidArgumentException('Categoria da CNH é obrigatória.');
        }
    }
}