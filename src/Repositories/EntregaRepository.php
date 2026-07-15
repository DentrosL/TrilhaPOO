<?php 

namespace App\Repositories;

use App\Models\Veiculo;
use App\Models\Motorista;
use App\Models\Encomenda;
use App\Models\Endereco;
use App\Models\Entrega;
use PDO;

class EntregaRepository extends BaseRepository
{
    public function criar(string $codigo, Encomenda $encomenda, Motorista $motorista, Veiculo $veiculo): bool
    {
        $sql = "
            INSERT INTO entregas
                (codigo, encomenda_id, motorista_id, veiculo_id)
            VALUES
                (:codigo, :encomenda_id, :motorista_id, :veiculo_id)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'codigo' => $codigo,
            'encomenda_id' => $encomenda->getId(),
            'motorista_id' => $motorista->getId(),
            'veiculo_id' => $veiculo->getId(),
        ]);
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM entregas WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM entregas";

        $stmt = $this->connection->query($sql);

        $entregas = [];
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $entrega = new Entrega(
                $data['codigo'],
                new Encomenda($data['encomenda_id'], '', '', 0, 0, new Endereco('', '', '', '', '', '', ''), new Endereco('', '', '', '', '', '', ''), 0),
                new Motorista($data['motorista_id'], '', '', ''),
                new Veiculo($data['veiculo_id'], '', '', 0, '')
            );
            $entrega->setId((int)$data['id']);
            $entregas[] = $entrega;
        }

        return $entregas;
    }
}