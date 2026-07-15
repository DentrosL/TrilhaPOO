<?php 

namespace App\Repositories;

use App\Models\Endereco;
use PDO;

class VeiculoRepository extends BaseRepository
{
    public function criar(Endereco $endereco): bool
    {
        $sql = "
            INSERT INTO enderecos
                (tipo, rua, numero, bairro, cidade, estado, cep)
            VALUES
                (:tipo, :rua, :numero, :bairro, :cidade, :estado, :cep)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'tipo' => $endereco->getTipo(),
            'rua' => $endereco->getRua(),
            'numero' => $endereco->getNumero(),
            'bairro' => $endereco->getBairro(),
            'cidade' => $endereco->getCidade(),
            'estado' => $endereco->getEstado(),
            'cep' => $endereco->getCep(),
        ]);
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM enderecos WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM enderecos";

        $stmt = $this->connection->query($sql);

        $enderecos = [];
        while ($data = $stmt->fetch(\PDO::FETCH_ASSOC)) {
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

    public function listarPorCliente(int $clienteId): array
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
    