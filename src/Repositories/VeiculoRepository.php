<?php

namespace App\Repositories;

use App\Models\Veiculo;
use PDO;

class VeiculoRepository extends BaseRepository
{
    public function criar(Veiculo $veiculo): bool
    {
        $sql = "
            INSERT INTO veiculos
                (marca, modelo, ano, placa)
            VALUES
                (:marca, :modelo, :ano, :placa)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'marca' => $veiculo->getMarca(),
            'modelo' => $veiculo->getModelo(),
            'ano' => $veiculo->getAno(),
            'placa' => $veiculo->getPlaca(),
        ]);
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM veiculos WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM veiculos";

        $stmt = $this->connection->query($sql);

        $veiculos = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $veiculo = new Veiculo(
                $data['placa'],
                $data['marca'],
                $data['modelo'],
                $data['cor'],
                (int)$data['ano']
            );
            $veiculo->setId((int)$data['id']);
            $veiculos[] = $veiculo;
        }

        return $veiculos;
    }
}