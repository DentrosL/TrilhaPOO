<?php

namespace App\Repositories;

use App\Models\Veiculos\Caminhao;
use App\Models\Veiculos\Moto;
use App\Models\Veiculos\Van;
use App\Models\Veiculo;
use PDO;

class VeiculoRepository extends BaseRepository
{
    public function criar(Veiculo $veiculo): bool
    {
        $sql = "INSERT INTO veiculos
                    (tipo, placa, modelo, cor, ano, capacidade_peso, capacidade_volume)
                VALUES
                (:tipo, :placa, :modelo, :cor, :ano, :capacidade_peso, :capacidade_volume)";
        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'tipo'               => class_basename($veiculo),
            'placa'              => $veiculo->getPlaca(),
            'modelo'             => $veiculo->getModelo(),
            'cor'                => $veiculo->getCor(),
            'ano'                => $veiculo->getAno(),
            'capacidade_peso'    => $veiculo->getCapacidadePeso(),
            'capacidade_volume'  => $veiculo->getCapacidadeVolume(),
        ]);
    }

    public function deletar(int $id): bool
    {
        $sql = "DELETE FROM veiculos WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'id' => $id,
        ]);
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM veiculos ORDER BY id";
        $stmt = $this->connection->query($sql);

        $veiculos = [];

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            switch ($data['tipo']) {
                case 'Moto':
                    $veiculo = new Moto(
                        $data['placa'],
                        $data['marca'],
                        $data['modelo'],
                        $data['cor'],
                        (int) $data['ano']
                    );
                    break;
                case 'Van':
                    $veiculo = new Van(
                        $data['placa'],
                        $data['marca'],
                        $data['modelo'],
                        $data['cor'],
                        (int) $data['ano']
                    );
                    break;
                default:
                    $veiculo = new Caminhao(
                        $data['placa'],
                        $data['marca'],
                        $data['modelo'],
                        $data['cor'],
                        (int) $data['ano']
                    );
            }

            $veiculo->setId((int) $data['id']);

            $veiculos[] = $veiculo;
        }

        return $veiculos;
    }

    public function buscarPorId(int $id): ?Veiculo
    {
        $sql = "SELECT * FROM veiculos WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            'id' => $id,
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }
        switch ($data['tipo']) {
            case 'Moto':
                $veiculo = new Moto(
                    $data['placa'],
                    $data['marca'],
                    $data['modelo'],
                    $data['cor'],
                    (int) $data['ano']
                );
                break;
            case 'Van':
                $veiculo = new Van(
                    $data['placa'],
                    $data['marca'],
                    $data['modelo'],
                    $data['cor'],
                    (int) $data['ano']
                );
                break;
            default:
                $veiculo = new Caminhao(
                    $data['placa'],
                    $data['marca'],
                    $data['modelo'],
                    $data['cor'],
                    (int) $data['ano']
                );
        }

        $veiculo->setId((int) $data['id']);

        return $veiculo;
    }
}