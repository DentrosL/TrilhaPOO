<?php

namespace App\Repositories;

use App\Models\Rastreamento;
use DateTime;
use PDO;

class RastreamentoRepository extends BaseRepository
{
    public function criar(Rastreamento $rastreamento, int $entregaId): bool
    {
        $sql = "INSERT INTO rastreamentos
                    (entrega_id, cidade, descricao, data_hora)
                VALUES
                    (:entrega_id, :cidade, :descricao, :data_hora)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'entrega_id' => $entregaId,
            'cidade'     => $rastreamento->getCidade(),
            'descricao'  => $rastreamento->getDescricao(),
            'data_hora'  => $rastreamento->getDataHora()->format('Y-m-d H:i:s'),
        ]);
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM rastreamentos WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'id' => $id,
        ]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM rastreamentos ORDER BY data_hora DESC";
        $stmt = $this->connection->query($sql);

        $rastreamentos = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $rastreamento = new Rastreamento(
                $data['cidade'],
                $data['descricao'],
                new DateTime($data['data_hora'])
            );

            $rastreamento->setId((int) $data['id']);

            $rastreamentos[] = $rastreamento;
        }

        return $rastreamentos;
    }

    public function listarPorEntrega(int $entregaId): array
    {
        $sql = "SELECT *
                FROM rastreamentos
                WHERE entrega_id = :entrega_id
                ORDER BY data_hora";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'entrega_id' => $entregaId,
        ]);

        $rastreamentos = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $rastreamento = new Rastreamento(
                $data['cidade'],
                $data['descricao'],
                new DateTime($data['data_hora'])
            );

            $rastreamento->setId((int) $data['id']);

            $rastreamentos[] = $rastreamento;
        }

        return $rastreamentos;
    }

    public function buscarPorId(int $id): ?Rastreamento
    {
        $sql = "SELECT * FROM rastreamentos WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $rastreamento = new Rastreamento(
            $data['cidade'],
            $data['descricao'],
            new DateTime($data['data_hora'])
        );

        $rastreamento->setId((int) $data['id']);

        return $rastreamento;
    }
}