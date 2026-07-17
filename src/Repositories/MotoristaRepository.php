<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Motorista;
use PDO;

class MotoristaRepository extends BaseRepository
{
    public function criar(Motorista $motorista): bool
    {
        $sql = "INSERT INTO motoristas
                    (nome, cpf, cnh, categoria, disponivel)
                VALUES
                    (:nome, :cpf, :cnh, :categoria, :disponivel)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'nome'        => $motorista->getNome(),
            'cpf'         => $motorista->getCpf(),
            'cnh'         => $motorista->getCnh(),
            'categoria'   => $motorista->getCategoria(),
            'disponivel'  => $motorista->isDisponivel(),
        ]);
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM motoristas WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'id' => $id,
        ]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM motoristas ORDER BY id";
        $stmt = $this->connection->query($sql);
        $motoristas = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $motorista = new Motorista(
                $data['nome'],
                $data['cnh'],
                $data['cpf'],
                $data['categoria']
            );

            $motorista->setId((int) $data['id']);
            $motorista->setDisponivel((bool) $data['disponivel']);

            $motoristas[] = $motorista;
        }

        return $motoristas;
    }

    public function buscarPorId(int $id): ?Motorista
    {
        $sql = "SELECT * FROM motoristas WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $motorista = new Motorista(
            $data['nome'],
            $data['cnh'],
            $data['cpf'],
            $data['categoria']
        );

        $motorista->setId((int) $data['id']);
        $motorista->setDisponivel((bool) $data['disponivel']);

        return $motorista;
    }

    public function buscarPorCpf(string $cpf): ?Motorista
    {
        $sql = "SELECT * FROM motoristas WHERE cpf = :cpf";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'cpf' => $cpf,
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $motorista = new Motorista(
            $data['nome'],
            $data['cnh'],
            $data['cpf'],
            $data['categoria']
        );

        $motorista->setId((int) $data['id']);
        $motorista->setDisponivel((bool) $data['disponivel']);

        return $motorista;
    }

    public function buscarPorCnh(string $cnh): ?Motorista
    {
        $sql = "SELECT * FROM motoristas WHERE cnh = :cnh";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'cnh' => $cnh,
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $motorista = new Motorista(
            $data['nome'],
            $data['cnh'],
            $data['cpf'],
            $data['categoria']
        );

        $motorista->setId((int) $data['id']);
        $motorista->setDisponivel((bool) $data['disponivel']);

        return $motorista;
    }
}
