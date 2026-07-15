<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Endereco;
use App\Models\Entrega;
use App\Models\Motorista;
use App\Models\Veiculo;
use PDO;

class EntregaRepository extends BaseRepository
{
    public function criar(Entrega $entrega): bool
    {
        $sql = "INSERT INTO entregas
                    (codigo, encomenda_id, motorista_id, veiculo_id)
                VALUES
                    (:codigo, :encomenda_id, :motorista_id, :veiculo_id)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'codigo'        => $entrega->getCodigo(),
            'encomenda_id'  => $entrega->getEncomenda()->getId(),
            'motorista_id'  => $entrega->getMotorista()->getId(),
            'veiculo_id'    => $entrega->getVeiculo()->getId()
        ]);
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM entregas WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'id' => $id,
        ]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM entregas ORDER BY id";
        $stmt = $this->connection->query($sql);
        $entregas = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cliente = new Cliente('', '', '', '');
            $origem = new Endereco('', '', '', '', '', '', '');
            $destino = new Endereco('', '', '', '', '', '', '');

            $encomenda = new Encomenda(
                '',
                $cliente,
                0,
                0,
                $origem,
                $destino,
                0,
            );
            $encomenda->setId((int) $data['encomenda_id']);

            $motorista = new Motorista('', '', '', '');
            $motorista->setId((int) $data['motorista_id']);

            $veiculo = new Veiculo('', '', '', '', '');
            $veiculo->setId((int) $data['veiculo_id']);

            $entrega = new Entrega(
                $data['codigo'],
                $encomenda,
                $motorista,
                $veiculo
            );

            $entrega->setId((int) $data['id']);

            $entregas[] = $entrega;
        }

        return $entregas;
    }

    public function buscarPorId(int $id): ?Entrega
    {
        $sql = "SELECT * FROM entregas WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            'id' => $id,
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $cliente = new Cliente('', '', '', '');
        $origem = new Endereco('', '', '', '', '', '', '');
        $destino = new Endereco('', '', '', '', '', '', '');

        $encomenda = new Encomenda(
            '',
            $cliente,
            0,
            0,
            $origem,
            $destino,
            0
        );
        $encomenda->setId((int) $data['encomenda_id']);

        $motorista = new Motorista('', '', '', '');
        $motorista->setId((int) $data['motorista_id']);

        $veiculo = new Veiculo('', '', '', '', '');
        $veiculo->setId((int) $data['veiculo_id']);

        $entrega = new Entrega(
            $data['codigo'],
            $encomenda,
            $motorista,
            $veiculo
        );

        $entrega->setId((int) $data['id']);

        return $entrega;
    }
}