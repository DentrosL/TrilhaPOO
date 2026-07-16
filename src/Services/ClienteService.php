<?php

namespace App\Services;

use App\Models\Cliente;
use App\Repositories\ClienteRepository;
use InvalidArgumentException;
use RuntimeException;

class ClienteService
{
    public function __construct(
        private ClienteRepository $repository = new ClienteRepository()
    ) {
    }

    public function criar(Cliente $cliente): bool
    {
        $this->validar($cliente);

        if ($this->repository->buscarPorCpf($cliente->getCpf())) {
            throw new RuntimeException('Já existe um cliente com este CPF.');
        }

        return $this->repository->criar($cliente);
    }

    public function atualizar(Cliente $cliente): bool
    {
        if (!$this->repository->buscarPorId($cliente->getId())) {
            throw new RuntimeException('Cliente não encontrado.');
        }

        $this->validar($cliente);

        return $this->repository->atualizar($cliente);
    }

    public function deletar(int $id): bool
    {
        if (!$this->repository->buscarPorId($id)) {
            throw new RuntimeException('Cliente não encontrado.');
        }

        return $this->repository->deletar($id);
    }

    public function listar(): array
    {
        return $this->repository->listar();
    }

    public function buscarPorId(int $id): ?Cliente
    {
        return $this->repository->buscarPorId($id);
    }

    private function validar(Cliente $cliente): void
    {
        if (trim($cliente->getNome()) === '') {
            throw new InvalidArgumentException('Nome é obrigatório.');
        }

        if (!filter_var($cliente->getEmail(), FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('E-mail inválido.');
        }

        if (!preg_match('/^\d{11}$/', preg_replace('/\D/', '', $cliente->getCpf()))) {
            throw new InvalidArgumentException('CPF inválido.');
        }

        if (trim($cliente->getTelefone()) === '') {
            throw new InvalidArgumentException('Telefone é obrigatório.');
        }
    }
}