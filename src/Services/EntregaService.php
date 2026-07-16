<?php

namespace App\Services;

use App\Models\Encomenda;
use App\Repositories\EncomendaRepository;
use InvalidArgumentException;
use RuntimeException;

class EncomendaService
{
    public function __construct(
        private EncomendaRepository $repository = new EncomendaRepository()
    ) {
    }

    public function criar(Encomenda $encomenda): bool
    {
        $this->validar($encomenda);

        if ($this->repository->buscarPorCodigo($encomenda->getCodigo())) {
            throw new RuntimeException('Já existe uma encomenda com este código.');
        }

        return $this->repository->criar($encomenda);
    }

    public function deletar(int $id): bool
    {
        if (!$this->repository->buscarPorId($id)) {
            throw new RuntimeException('Encomenda não encontrada.');
        }

        return $this->repository->deletar($id);
    }

    public function listar(): array
    {
        return $this->repository->listar();
    }

    public function buscarPorId(int $id): ?Encomenda
    {
        return $this->repository->buscarPorId($id);
    }

    private function validar(Encomenda $encomenda): void
    {
        if (trim($encomenda->getCodigo()) === '') {
            throw new InvalidArgumentException('Código é obrigatório.');
        }

        if ($encomenda->getCliente()->getId() <= 0) {
            throw new InvalidArgumentException('Cliente inválido.');
        }

        if ($encomenda->getOrigem()->getId() <= 0) {
            throw new InvalidArgumentException('Endereço de origem inválido.');
        }

        if ($encomenda->getDestino()->getId() <= 0) {
            throw new InvalidArgumentException('Endereço de destino inválido.');
        }

        if ($encomenda->getOrigem()->getId() === $encomenda->getDestino()->getId()) {
            throw new InvalidArgumentException('Origem e destino devem ser diferentes.');
        }

        if ($encomenda->getPeso() <= 0) {
            throw new InvalidArgumentException('Peso deve ser maior que zero.');
        }

        if ($encomenda->getVolume() <= 0) {
            throw new InvalidArgumentException('Volume deve ser maior que zero.');
        }

        if ($encomenda->getValor() < 0) {
            throw new InvalidArgumentException('Valor inválido.');
        }
    }
}