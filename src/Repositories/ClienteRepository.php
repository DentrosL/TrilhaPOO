<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Models\Endereco;
use PDO;

class ClienteRepository extends BaseRepository
{
    public function criar(Cliente $cliente): bool
    {
        $sql = "INSERT INTO clientes
                    (nome, email, telefone, cpf)
                VALUES
                    (:nome, :email, :telefone, :cpf)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'nome' => $cliente->getNome(),
            'email' => $cliente->getEmail(),
            'telefone' => $cliente->getTelefone(),
            'cpf' => $cliente->getCpf(),
        ]);
    }

    public function atualizar(Cliente $cliente): bool
    {
        $sql = "UPDATE clientes
                SET nome = :nome, email = :email, telefone = :telefone, cpf = :cpf
                WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'nome' => $cliente->getNome(),
            'email' => $cliente->getEmail(),
            'telefone' => $cliente->getTelefone(),
            'cpf' => $cliente->getCpf(),
            'id' => $cliente->getId(),
        ]);
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM clientes WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->connection->query($sql);

        $clientes = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cliente = new Cliente($data['nome'], $data['email'], $data['telefone'], $data['cpf']);
            $cliente->setId($data['id']);
            $clientes[] = $cliente;
        }

        return $clientes;
    }

    public function buscarPorId(int $id): ?Cliente
    {
        $sql = "SELECT * FROM clientes WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $cliente = new Cliente($data['nome'], $data['email'], $data['telefone'], $data['cpf']);
            $cliente->setId($data['id']);
            return $cliente;
        }

        return null;
    }

    public function enderecosDoCliente(int $clienteId): array
    {
        $sql = "SELECT * FROM enderecos WHERE cliente_id = :cliente_id";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(['cliente_id' => $clienteId]);

        $enderecos = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $endereco = new Endereco(
                $data['tipo'],
                $data['rua'],
                $data['numero'],
                $data['bairro'],
                $data['cidade'],
                $data['estado'],
                $data['cep']
            );
            $endereco->setId($data['id']);
            $enderecos[] = $endereco;
        }

        return $enderecos;
    }
}