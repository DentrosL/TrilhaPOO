<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Entrega;
use DateTimeImmutable;
use PDO;
use RuntimeException;

class EntregaRepository extends BaseRepository
{
    public function __construct(private EncomendaRepository $encomendas = new EncomendaRepository(), private MotoristaRepository $motoristas = new MotoristaRepository(), private VeiculoRepository $veiculos = new VeiculoRepository())
    {
        parent::__construct();
    }
    public function criar(Entrega $entrega): bool
    {
        $stmt = $this->connection->prepare('INSERT INTO entregas (codigo, encomenda_id, motorista_id, veiculo_id, status, data_saida, data_prevista, data_entrega) VALUES (:codigo, :encomenda_id, :motorista_id, :veiculo_id, :status, :data_saida, :data_prevista, :data_entrega)');
        return $stmt->execute($this->parametros($entrega));
    }
    public function atualizarStatus(int $id, string $status, ?DateTimeImmutable $dataEntrega): bool
    {
        $stmt = $this->connection->prepare('UPDATE entregas SET status = :status, data_entrega = :data_entrega WHERE id = :id');
        return $stmt->execute(['id' => $id, 'status' => $status, 'data_entrega' => $dataEntrega?->format('Y-m-d H:i:s')]);
    }
    public function deletar(int $id): bool
    {
        $stmt = $this->connection->prepare('DELETE FROM entregas WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
    public function listar(): array
    {
        return array_map(fn (array $data): Entrega => $this->hidratar($data), $this->connection->query('SELECT * FROM entregas ORDER BY id DESC')->fetchAll(PDO::FETCH_ASSOC));
    }
    public function buscarPorId(int $id): ?Entrega
    {
        $stmt = $this->connection->prepare('SELECT * FROM entregas WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ? $this->hidratar($data) : null;
    }
    private function parametros(Entrega $entrega): array
    {
        return ['codigo' => $entrega->getCodigo(), 'encomenda_id' => $entrega->getEncomenda()->getId(), 'motorista_id' => $entrega->getMotorista()->getId(), 'veiculo_id' => $entrega->getVeiculo()->getId(), 'status' => $entrega->getStatus(), 'data_saida' => $entrega->getDataSaida()?->format('Y-m-d H:i:s'), 'data_prevista' => $entrega->getDataPrevista()?->format('Y-m-d H:i:s'), 'data_entrega' => $entrega->getDataEntrega()?->format('Y-m-d H:i:s')];
    }
    private function hidratar(array $data): Entrega
    {
        $encomenda = $this->encomendas->buscarPorId((int) $data['encomenda_id']);
        $motorista = $this->motoristas->buscarPorId((int) $data['motorista_id']);
        $veiculo = $this->veiculos->buscarPorId((int) $data['veiculo_id']);
        if (!$encomenda || !$motorista || !$veiculo) {
            throw new RuntimeException('Dados da entrega não encontrados.');
        } $entrega = new Entrega($data['codigo'], $encomenda, $motorista, $veiculo, $data['status'] ?? 'Aguardando', $data['data_saida'] ? new DateTimeImmutable($data['data_saida']) : null, $data['data_prevista'] ? new DateTimeImmutable($data['data_prevista']) : null, $data['data_entrega'] ? new DateTimeImmutable($data['data_entrega']) : null);
        $entrega->setId((int) $data['id']);
        return $entrega;
    }
}
