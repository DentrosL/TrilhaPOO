<?php

declare(strict_types=1);

$baseDir = dirname(__DIR__);

$checks = [
    'public/views/clientes.php' => ['name="acao" value="criar_cliente"', 'name="acao" value="remover_cliente"', 'name="acao" value="editar_cliente"', 'name="acao" value="criar_endereco"'],
    'public/views/veiculos.php' => ['name="acao" value="criar_veiculo"', 'name="acao" value="remover_veiculo"'],
    'public/views/motoristas.php' => ['name="acao" value="criar_motorista"', 'name="acao" value="remover_motorista"'],
    'public/views/encomendas.php' => ['name="acao" value="criar_encomenda"', 'name="acao" value="remover_encomenda"'],
    'public/views/entregas.php' => ['name="acao" value="criar_entrega"', 'name="acao" value="remover_entrega"'],
];

$failures = [];
foreach ($checks as $file => $expected) {
    $path = $baseDir . '/' . $file;
    if (!file_exists($path)) {
        $failures[] = "Arquivo ausente: {$file}";
        continue;
    }

    $content = file_get_contents($path);
    foreach ($expected as $needle) {
        if (!str_contains($content, $needle)) {
            $failures[] = "{$file} está sem {$needle}";
        }
    }
}

if ($failures !== []) {
    fwrite(STDERR, implode(PHP_EOL, $failures) . PHP_EOL);
    exit(1);
}

echo "Testes de interface concluídos." . PHP_EOL;
