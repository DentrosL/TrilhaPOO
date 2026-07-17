<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Encomenda;
use PDO;

class EncomendaRepository extends BaseRepository
{
    private ClienteRepository $clienteRepository;
    private EnderecoRepository $enderecoRepository;

    public function __construct()
    {
        parent::__construct();

        $this->clienteRepository = new ClienteRepository();
        $this->enderecoRepository = new EnderecoRepository();
    }

    public function criar(Encomenda $encomenda): bool
    {
        $sql = "INSERT INTO encomendas
                    (codigo, cliente_id, origem_id, destino_id, peso, volume, valor)
                VALUES
                    (:codigo, :cliente_id, :origem_id, :destino_id, :peso, :volume, :valor)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'codigo'        => $encomenda->getCodigo(),
            'cliente_id'    => $encomenda->getCliente()->getId(),
            'origem_id'     => $encomenda->getOrigem()->getId(),
            'destino_id'    => $encomenda->getDestino()->getId(),
            'peso'          => $encomenda->getPeso(),
            'volume'        => $encomenda->getVolume(),
            'valor'         => $encomenda->getValor(),
        ]);
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM encomendas WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }

    public function listar(): array
    {
        $stmt = $this->connection->query("SELECT id FROM encomendas");

        $encomendas = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $encomendas[] = $this->buscarPorId((int) $data['id']);
        }

        return $encomendas;
    }

    public function buscarPorId(int $id): ?Encomenda
    {
        $sql = "SELECT * FROM encomendas WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        $cliente = $this->clienteRepository->buscarPorId((int) $data['cliente_id']);
        $origem = $this->enderecoRepository->buscarPorId((int) $data['origem_id']);
        $destino = $this->enderecoRepository->buscarPorId((int) $data['destino_id']);

        $encomenda = new Encomenda(
            $data['codigo'],
            $cliente,
            (float) $data['peso'],
            (float) $data['volume'],
            $origem,
            $destino,
            (float) $data['valor']
        );

        $encomenda->setId((int) $data['id']);

        return $encomenda;
    }

    public function buscarPorCodigo(string $codigo): ?Encomenda
    {
        $sql = "SELECT id FROM encomendas WHERE codigo = :codigo";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            'codigo' => $codigo,
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return $this->buscarPorId((int) $data['id']);
    }

}
