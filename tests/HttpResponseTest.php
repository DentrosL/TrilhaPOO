<?php

declare(strict_types=1);

require_once __DIR__ . '/TestCase.php';

use Tests\TestCase;

$test = new TestCase();
$baseUrl = rtrim(getenv('APP_URL') ?: 'http://127.0.0.1:8000', '/');
$pages = [
    'dashboard' => 'Sistema de Gestão de Transportadora',
    'clientes' => 'Lista de Clientes',
    'encomendas' => 'Encomendas',
    'entregas' => 'Entregas',
    'veiculos' => 'Frota',
    'motoristas' => 'Motoristas',
    'rastreamento' => 'Histórico de movimentações',
];

foreach ($pages as $page => $content) {
    $response = @file_get_contents("{$baseUrl}/home.php?page={$page}");
    $status = $http_response_header[0] ?? '';
    $test->assertTrue(str_contains($status, '200'), "A página {$page} deve responder com HTTP 200");
    $test->assertTrue(is_string($response) && str_contains($response, $content), "A resposta da página {$page} deve conter o conteúdo esperado");
}

echo sprintf("Respostas HTTP concluídas com %d verificações.\n", $test->total());
