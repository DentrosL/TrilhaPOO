<?php
$page = $_GET['page'] ?? 'dashboard';

$pages = [
    'dashboard',
    'clientes',
    'veiculos',
    'motoristas',
    'encomendas',
    'entregas',
    'rastreamento',
    'configuracoes'
];

if (!in_array($page, $pages, true)) {
    $page = 'dashboard';
}

function active(string $currentPage, string $page): string
{
    return $currentPage === $page ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestão de Transportadora</title>
    <link rel="stylesheet" href="/assets/css/dashboard.css">
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="logo">
                <span>TMS</span>
            </div>
            <nav>
                <nav>
                    <a class="<?= active($page, 'dashboard')?>" href="?page=dashboard">Dashboard</a>
                    <a class="<?= active($page, 'clientes')?>" href="?page=clientes">Clientes</a>
                    <a class="<?= active($page, 'encomendas')?>" href="?page=encomendas">Encomendas</a>
                    <a class="<?= active($page, 'veiculos')?>" href="?page=veiculos">Veículos</a>
                    <a class="<?= active($page, 'motoristas')?>" href="?page=motoristas">Motoristas</a>
                    <a class="<?= active($page, 'rastreamento')?>" href="?page=rastreamento">Rastreamento</a>
                    <a class="<?= active($page, 'configuracoes')?>" href="?page=configuracoes">Configurações</a>
                </nav>
            </nav>
        </aside>
        <main>
            <?php require __DIR__."/views/{$page}.php";?>
        </main>
    </div>
</body>
</html>