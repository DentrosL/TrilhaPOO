<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Enums\StatusEntrega;
use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Endereco;
use App\Models\Entrega;
use App\Models\Motorista;
use App\Models\Veiculos\Moto;

if (StatusEntrega::from('Entregue') !== StatusEntrega::ENTREGUE) {
    throw new RuntimeException('Status de entrega inválido.');
}

if (!in_array('Em trânsito', StatusEntrega::valores(), true)) {
    throw new RuntimeException('Lista de status inválida.');
}

$cliente = new Cliente('Cliente', 'cliente@example.com', '47999999999', '11111111111');
$origem = new Endereco($cliente, 'Rua A', '1', 'Centro', 'Joinville', 'SC', '89200000', 'Origem');
$destino = new Endereco($cliente, 'Rua B', '2', 'Centro', 'Blumenau', 'SC', '89000000', 'Destino');
$entrega = new Entrega('ENT001', new Encomenda('ENC001', $cliente, 1, 0.1, $origem, $destino, 10), new Motorista('Motorista', '123', '22222222222', 'A'), new Moto('ABC1A11', 'CG 160', 'Preta', 2024));

if ($entrega->getStatus() !== StatusEntrega::AGUARDANDO->value) {
    throw new RuntimeException('Status inicial inválido.');
}

echo "Testes básicos concluídos.\n";
