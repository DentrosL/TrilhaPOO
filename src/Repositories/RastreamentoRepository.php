<?php

namespace App\Repositories;

use App\Models\Rastreamento;
use DateTime;
use PDO;

class RastreamentoRepository extends BaseRepository
{

    // private string $cidade;
    // private string $descricao;
    // private DateTime $dataHora;

    public function criar(string $cidade, float $descricao, float $data_hora): bool
    {
        $sql = "
            INSERT INTO rastreamentos
                (cidade, descricao, data_hora)
            VALUES
                (:cidade, :descricao, :data_hora)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'cidade' => $cidade,
            'descricao' => $descricao,
            'data_hora' => $data_hora,
        ]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM rastreamentos";

        $stmt = $this->connection->query($sql);

        $rastreamentos = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rastreamento = new Rastreamento(
                $data['cidade'],
                $data['descricao'],
                new DateTime($data['data_hora'])
            );
            $rastreamento->setId((int)$data['id']);
            $rastreamentos[] = $rastreamento;
        }

        return $rastreamentos;
    }
}