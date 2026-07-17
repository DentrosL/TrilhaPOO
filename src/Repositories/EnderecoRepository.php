<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Cliente;
use App\Models\Endereco;
use PDO;
use RuntimeException;

class EnderecoRepository extends BaseRepository
{
    public function __construct(private ClienteRepository $clientes = new ClienteRepository())
    {
        parent::__construct();
    }

    public function criar(Endereco $endereco): bool
    {
        $stmt = $this->connection->prepare('INSERT INTO enderecos (cliente_id, tipo, rua, numero, bairro, cidade, estado, cep) VALUES (:cliente_id, :tipo, :rua, :numero, :bairro, :cidade, :estado, :cep)');
        return $stmt->execute(['cliente_id' => $endereco->getCliente()->getId(), 'tipo' => $endereco->getTipo(), 'rua' => $endereco->getRua(), 'numero' => $endereco->getNumero(), 'bairro' => $endereco->getBairro(), 'cidade' => $endereco->getCidade(), 'estado' => $endereco->getEstado(), 'cep' => $endereco->getCep()]);
    }

    public function deletar(int $id): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM enderecos WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function listar(): array
    {
        return array_map(fn (array $data): Endereco => $this->hidratar($data), $this->connection->query('SELECT * FROM enderecos ORDER BY id')->fetchAll(PDO::FETCH_ASSOC));
    }

    public function listarPorCliente(int $clienteId): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM enderecos WHERE cliente_id = :cliente_id ORDER BY id');
        $stmt->execute(['cliente_id' => $clienteId]);
        return array_map(fn (array $data): Endereco => $this->hidratar($data), $stmt->fetchAll(PDO::FETCH_ASSOC));
    }

    public function buscarPorId(int $id): ?Endereco
    {
        $stmt = $this->connection->prepare('SELECT * FROM enderecos WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? $this->hidratar($data) : null;
    }

    private function hidratar(array $data): Endereco
    {
        $cliente = $this->clientes->buscarPorId((int) $data['cliente_id']);
        if (!$cliente instanceof Cliente) {
            throw new RuntimeException('Cliente do endereço não encontrado.');
        }
        $endereco = new Endereco($cliente, $data['rua'], $data['numero'], $data['bairro'], $data['cidade'], $data['estado'], $data['cep'], $data['tipo']);
        $endereco->setId((int) $data['id']);
        return $endereco;
    }
}
