<?php

namespace App\Services;

use App\Models\Endereco;
use App\Repositories\EnderecoRepository;
use InvalidArgumentException;
use RuntimeException;

class EnderecoService
{
    private EnderecoRepository $repository;

    public function __construct()
    {
        $this->repository = new EnderecoRepository();
    }

    public function cadastrar(Endereco $endereco): void
    {
        if (!$endereco->getCliente()->getId()) {
            throw new InvalidArgumentException("Cliente inválido.");
        }

        if (empty(trim($endereco->getRua()))) {
            throw new InvalidArgumentException("A rua é obrigatória.");
        }

        if (empty(trim($endereco->getNumero()))) {
            throw new InvalidArgumentException("O número é obrigatório.");
        }

        if (empty(trim($endereco->getBairro()))) {
            throw new InvalidArgumentException("O bairro é obrigatório.");
        }

        if (empty(trim($endereco->getCidade()))) {
            throw new InvalidArgumentException("A cidade é obrigatória.");
        }

        if (empty(trim($endereco->getEstado()))) {
            throw new InvalidArgumentException("O estado é obrigatório.");
        }

        if (empty(trim($endereco->getCep()))) {
            throw new InvalidArgumentException("O CEP é obrigatório.");
        }

        if (empty(trim($endereco->getTipo()))) {
            throw new InvalidArgumentException("O tipo do endereço é obrigatório.");
        }

        $this->repository->criar($endereco);
    }

    public function remover(int $id): void
    {
        if (!$this->repository->buscarPorId($id)) {
            throw new RuntimeException("Endereço não encontrado.");
        }

        $this->repository->deletar($id);
    }

    public function buscarPorId(int $id): Endereco
    {
        $endereco = $this->repository->buscarPorId($id);

        if (!$endereco) {
            throw new RuntimeException("Endereço não encontrado.");
        }

        return $endereco;
    }

    public function listar(): array
    {
        return $this->repository->listar();
    }

    public function listarPorCliente(int $clienteId): array
    {
        return $this->repository->listarPorCliente($clienteId);
    }
}