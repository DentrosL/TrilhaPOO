<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/TestCase.php';

use App\Database\Connection;
use App\Enums\StatusEntrega;
use App\Exceptions\EntregaFinalizadaException;
use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Endereco;
use App\Models\Entrega;
use App\Services\ClienteService;
use App\Services\EntregaService;
use App\Services\EncomendaService;
use App\Services\EnderecoService;
use App\Services\FreteService;
use App\Services\MotoristaService;
use App\Services\RastreamentoService;
use App\Services\VeiculoService;
use DateTime;
use InvalidArgumentException;
use Tests\TestCase;

$test = new TestCase();
$connection = Connection::getConnection();
$connection->beginTransaction();

try {
    $clienteService = new ClienteService();
    $enderecoService = new EnderecoService();
    $encomendaService = new EncomendaService();
    $entregaService = new EntregaService();
    $rastreamentoService = new RastreamentoService();
    $motoristaService = new MotoristaService();
    $veiculoService = new VeiculoService();
    $freteService = new FreteService();

    $test->assertTrue(count($clienteService->listar()) > 0, 'A listagem de clientes deve retornar dados');
    $test->assertTrue(count($motoristaService->listar()) > 0, 'A listagem de motoristas deve retornar dados');
    $test->assertTrue(count($veiculoService->listar()) > 0, 'A listagem de veículos deve retornar dados');

    $test->assertThrows(InvalidArgumentException::class, static fn () => $clienteService->criar(new Cliente('', 'invalido', '', '1')), 'O serviço deve rejeitar cliente inválido');

    $token = bin2hex(random_bytes(6));
    $cliente = new Cliente("Cliente Teste {$token}", "{$token}@example.com", '47999999999', substr(str_pad((string) random_int(1, 99999999999), 11, '0', STR_PAD_LEFT), 0, 11));
    $test->assertTrue($clienteService->criar($cliente), 'O serviço deve criar um cliente válido');
    $cliente->setId((int) $connection->lastInsertId());
    $test->assertSame($cliente->getNome(), $clienteService->buscarPorId($cliente->getId())?->getNome(), 'O cliente criado deve ser encontrado');

    $origem = new Endereco($cliente, 'Rua de Origem', '100', 'Centro', 'Joinville', 'SC', '89200000', 'Coleta');
    $enderecoService->cadastrar($origem);
    $origem->setId((int) $connection->lastInsertId());

    $destino = new Endereco($cliente, 'Rua de Destino', '200', 'Centro', 'Blumenau', 'SC', '89010000', 'Entrega');
    $enderecoService->cadastrar($destino);
    $destino->setId((int) $connection->lastInsertId());
    $test->assertSame(2, count($enderecoService->listarPorCliente($cliente->getId())), 'Os endereços criados devem ser listados por cliente');

    $encomenda = new Encomenda("TST{$token}", $cliente, 10.0, 0.1, $origem, $destino, 150.0);
    $encomendaService->cadastrar($encomenda);
    $encomenda->setId((int) $connection->lastInsertId());
    $test->assertSame($encomenda->getCodigo(), $encomendaService->buscarPorCodigo($encomenda->getCodigo())->getCodigo(), 'A encomenda criada deve ser encontrada pelo código');
    $test->assertSame(45.0, $freteService->calcular($encomenda), 'O cálculo de frete deve usar peso, volume e taxa fixa');

    $motorista = array_values(array_filter($motoristaService->listar(), static fn ($item): bool => $item->isDisponivel()))[0];
    $veiculo = array_values(array_filter($veiculoService->listar(), static fn ($item): bool => $item->getCapacidadePeso() >= 10 && $item->getCapacidadeVolume() >= 0.1))[0];
    $entrega = new Entrega("ENT{$token}", $encomenda, $motorista, $veiculo);
    $test->assertTrue($entregaService->criar($entrega), 'O serviço deve criar uma entrega válida');
    $entrega->setId((int) $connection->lastInsertId());

    $test->assertTrue($entregaService->atualizarStatus($entrega->getId(), StatusEntrega::EM_TRANSITO->value), 'O status da entrega deve ser atualizado');
    $test->assertSame(StatusEntrega::EM_TRANSITO->value, $entregaService->buscarPorId($entrega->getId())->getStatus(), 'A entrega deve retornar o status atualizado');

    $test->assertTrue($rastreamentoService->registrarMovimentacao($entrega->getId(), StatusEntrega::SAIU_PARA_ENTREGA->value, 'Blumenau', 'Entrega em rota final', new DateTime()), 'O envio de movimentação deve ser registrado');
    $test->assertSame(1, count($rastreamentoService->listarPorEntrega($entrega->getId())), 'O histórico deve conter a movimentação enviada');

    $test->assertTrue($rastreamentoService->registrarMovimentacao($entrega->getId(), StatusEntrega::ENTREGUE->value, 'Blumenau', 'Entrega concluída', new DateTime()), 'A entrega deve poder ser finalizada');
    $test->assertThrows(EntregaFinalizadaException::class, fn () => $entregaService->atualizarStatus($entrega->getId(), StatusEntrega::EM_TRANSITO->value), 'Uma entrega finalizada não deve aceitar novo status');

    $clienteAtualizado = new Cliente("Cliente Atualizado {$token}", $cliente->getEmail(), '47988888888', $cliente->getCpf());
    $clienteAtualizado->setId($cliente->getId());
    $test->assertTrue($clienteService->atualizar($clienteAtualizado), 'O serviço deve atualizar um cliente válido');
    $test->assertSame($clienteAtualizado->getNome(), $clienteService->buscarPorId($cliente->getId())?->getNome(), 'A resposta da busca deve refletir a atualização');

    echo sprintf("Integração concluída com %d verificações. Rollback aplicado.\n", $test->total());
} finally {
    if ($connection->inTransaction()) {
        $connection->rollBack();
    }
}
