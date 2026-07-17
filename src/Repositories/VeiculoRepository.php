<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Veiculo;
use App\Models\Veiculos\Caminhao;
use App\Models\Veiculos\Moto;
use App\Models\Veiculos\Van;
use PDO;

class VeiculoRepository extends BaseRepository
{
    public function criar(Veiculo $veiculo): bool
    {
        $stmt = $this->connection->prepare('INSERT INTO veiculos (tipo, placa, modelo, cor, ano, capacidade_peso, capacidade_volume) VALUES (:tipo, :placa, :modelo, :cor, :ano, :capacidade_peso, :capacidade_volume)');
        return $stmt->execute(['tipo' => match ($veiculo::class) {
            Moto::class => 'Moto', Van::class => 'Van', default => 'Caminhao'
        }, 'placa' => $veiculo->getPlaca(), 'modelo' => $veiculo->getModelo(), 'cor' => $veiculo->getCor(), 'ano' => $veiculo->getAno(), 'capacidade_peso' => $veiculo->getCapacidadePeso(), 'capacidade_volume' => $veiculo->getCapacidadeVolume()]);
    }
    public function deletar(int $id): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM veiculos WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
    public function listar(): array
    {
        return array_map(fn (array $data): Veiculo => $this->hidratar($data), $this->connection->query('SELECT * FROM veiculos ORDER BY id')->fetchAll(PDO::FETCH_ASSOC));
    }
    public function buscarPorId(int $id): ?Veiculo
    {
        $stmt = $this->connection->prepare('SELECT * FROM veiculos WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? $this->hidratar($data) : null;
    }
    private function hidratar(array $data): Veiculo
    {
        $classe = match ($data['tipo']) {
            'Moto' => Moto::class, 'Van' => Van::class, default => Caminhao::class
        };
        $veiculo = new $classe($data['placa'], $data['modelo'], $data['cor'] ?? '', (int) $data['ano']);
        $veiculo->setId((int) $data['id']);
        return $veiculo;
    }
}
