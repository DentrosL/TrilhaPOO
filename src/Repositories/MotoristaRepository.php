<?php

namespace App\Repositories;

use App\Models\Motorista;
use PDO;

class MotoristaRepository extends BaseRepository
{
    public function criar(Motorista $motorista): bool
    {
        $sql = "
            INSERT INTO motoristas
                (nome, cpf, cnh)
            VALUES
                (:nome, :cpf, :cnh)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'nome' => $motorista->getNome(),
            'cpf' => $motorista->getCpf(),
            'cnh' => $motorista->getCnh(),
        ]);
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM motoristas WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM motoristas";

        $stmt = $this->connection->query($sql);

        $motoristas = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $motorista = new Motorista(
                (int)$data['id'],
                $data['nome'],
                $data['cpf'],
                $data['cnh']
            );
            $motoristas[] = $motorista;
        }

        return $motoristas;
    }
}