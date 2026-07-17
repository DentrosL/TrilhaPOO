<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\StatusEntrega;
use App\Models\Rastreamento;
use App\Repositories\EntregaRepository;
use App\Repositories\RastreamentoRepository;
use App\Traits\Logger;
use DateTime;
use InvalidArgumentException;
use RuntimeException;

class RastreamentoService
{
    use Logger;

    public function __construct(private RastreamentoRepository $repository = new RastreamentoRepository(), private EntregaRepository $entregas = new EntregaRepository(), private EntregaService $entregaService = new EntregaService())
    {
    }

    public function registrarMovimentacao(int $entregaId, string $status, string $cidade, string $descricao, ?DateTime $dataHora = null): bool
    {
        $this->validar($cidade, $descricao);
        if (!in_array($status, StatusEntrega::valores(), true)) {
            throw new InvalidArgumentException('Status de entrega inválido.');
        }
        if (!$this->entregas->buscarPorId($entregaId)) {
            throw new RuntimeException('Entrega não encontrada.');
        }
        $this->entregaService->atualizarStatus($entregaId, $status);
        $rastreamento = new Rastreamento($cidade, $descricao, $dataHora ?? new DateTime());
        $criado = $this->repository->criar($rastreamento, $entregaId);
        $this->registrarLog("Entrega {$entregaId} atualizada para {$status} em {$cidade}.");
        return $criado;
    }

    public function cadastrar(Rastreamento $rastreamento, int $entregaId): bool
    {
        $this->validar($rastreamento->getCidade(), $rastreamento->getDescricao());
        if (!$this->entregas->buscarPorId($entregaId)) {
            throw new RuntimeException('Entrega não encontrada.');
        } return $this->repository->criar($rastreamento, $entregaId);
    }
    public function remover(int $id): bool
    {
        if (!$this->repository->buscarPorId($id)) {
            throw new RuntimeException('Rastreamento não encontrado.');
        } return $this->repository->deletar($id);
    }
    public function buscarPorId(int $id): Rastreamento
    {
        $rastreamento = $this->repository->buscarPorId($id);
        if (!$rastreamento) {
            throw new RuntimeException('Rastreamento não encontrado.');
        } return $rastreamento;
    }
    public function listar(): array
    {
        return $this->repository->listar();
    }
    public function listarPorEntrega(int $entregaId): array
    {
        if (!$this->entregas->buscarPorId($entregaId)) {
            throw new RuntimeException('Entrega não encontrada.');
        } return $this->repository->listarPorEntrega($entregaId);
    }
    private function validar(string $cidade, string $descricao): void
    {
        if (trim($cidade) === '') {
            throw new InvalidArgumentException('A cidade é obrigatória.');
        } if (trim($descricao) === '') {
            throw new InvalidArgumentException('A descrição é obrigatória.');
        }
    }
}
