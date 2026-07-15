<?php 

namespace App\Repositories;

use App\Models\Endereco;
use PDO;

class EnderecoRepository extends BaseRepository
{
    public function criar(Endereco $endereco): bool
    {
        $sql = "
            INSERT INTO enderecos
                (cliente_id, tipo, rua, numero, bairro, cidade, estado, cep)
            VALUES
                (:cliente_id, :tipo, :rua, :numero, :bairro, :cidade, :estado, :cep)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'cliente_id' => $endereco->getCliente()->getId(),
            'tipo'       => $endereco->getTipo(),
            'rua'        => $endereco->getRua(),
            'numero'     => $endereco->getNumero(),
            'bairro'     => $endereco->getBairro(),
            'cidade'     => $endereco->getCidade(),
            'estado'     => $endereco->getEstado(),
            'cep'        => $endereco->getCep(),
        ]);
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM enderecos WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'id' => $id,
        ]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM enderecos ORDER BY id";
        $stmt = $this->connection->query($sql);
        $enderecos = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $endereco = new Endereco(
                $data['rua'],
                $data['numero'],
                $data['bairro'],
                $data['cidade'],
                $data['estado'],
                $data['cep'],
                $data['tipo']
            );

            $endereco->setId((int) $data['id']);
            $enderecos[] = $endereco;
        }

        return $enderecos;
    }

    public function listarPorCliente(int $clienteId): array
    {
        $sql = "
            SELECT *
            FROM enderecos
            WHERE cliente_id = :cliente_id
            ORDER BY id
        ";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            'cliente_id' => $clienteId,
        ]);

        $enderecos = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $endereco = new Endereco(
                $data['rua'],
                $data['numero'],
                $data['bairro'],
                $data['cidade'],
                $data['estado'],
                $data['cep'],
                $data['tipo']
            );

            $endereco->setId((int) $data['id']);

            $enderecos[] = $endereco;
        }

        return $enderecos;
    }

    public function buscarPorId(int $id): ?Endereco
    {
        $sql = "SELECT * FROM enderecos WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            'id' => $id,
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $endereco = new Endereco(
            $data['rua'],
            $data['numero'],
            $data['bairro'],
            $data['cidade'],
            $data['estado'],
            $data['cep'],
            $data['tipo']
        );

        $endereco->setId((int) $data['id']);

        return $endereco;
    }
}
    