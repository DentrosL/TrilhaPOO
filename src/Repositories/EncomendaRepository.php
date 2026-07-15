<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Endereco;
use PDO;

class EncomendaRepository extends BaseRepository
{
    public function criar(string $codigo, Cliente $cliente, float $peso, float $volume, Endereco $origem, Endereco $destino, float $valor): bool
    {
        $sql = "
            INSERT INTO encomendas
                (codigo, cliente_id, origem_id, destino_id, peso, volume, valor)
            VALUES
                (:codigo, :cliente_id, :origem_id, :destino_id, :peso, :volume, :valor)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'codigo' => $codigo,
            'cliente_id' => $cliente->getId(),
            'origem_id' => $origem->getId(),
            'destino_id' => $destino->getId(),
            'peso' => $peso,
            'volume' => $volume,
            'valor' => $valor,
        ]);
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM encomendas WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM encomendas";

        $stmt = $this->connection->query($sql);

        $encomendas = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $encomenda = new Encomenda(
                $data['codigo'],
                new Cliente($data['cliente_id'], '', '', ''),
                (float)$data['peso'],
                (float)$data['volume'],
                new Endereco($data['origem_id'], '', '', '', '', '', ''),
                new Endereco($data['destino_id'], '', '', '', '', '', ''),
                (float)$data['valor']
            );
            $encomenda->setId((int)$data['id']);
            $encomendas[] = $encomenda;
        }

        return $encomendas;
    }
}