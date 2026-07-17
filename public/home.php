<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Enums\StatusEntrega;
use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Endereco;
use App\Models\Entrega;
use App\Models\Motorista;
use App\Models\Veiculos\Caminhao;
use App\Models\Veiculos\Moto;
use App\Models\Veiculos\Van;
use App\Services\ClienteService;
use App\Services\EncomendaService;
use App\Services\EnderecoService;
use App\Services\EntregaService;
use App\Services\MotoristaService;
use App\Services\RastreamentoService;
use App\Services\VeiculoService;

$page = $_GET['page'] ?? 'dashboard';
$pages = ['dashboard', 'clientes', 'veiculos', 'motoristas', 'encomendas', 'entregas', 'rastreamento', 'configuracoes'];
if (!in_array($page, $pages, true)) {
    $page = 'dashboard';
}

function active(string $currentPage, string $page): string
{
    return $currentPage === $page ? 'active' : '';
}
function esc(string|int|float|null $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
function classeStatus(string $status): string
{
    return match ($status) {
        StatusEntrega::ENTREGUE->value => 'success', StatusEntrega::EM_TRANSITO->value, StatusEntrega::SAIU_PARA_ENTREGA->value => 'warning', default => 'info'
    };
}

$erro = null;
$sucesso = null;
$historico = [];
$clientes = $veiculos = $motoristas = $encomendas = $entregas = $rastreamentos = $enderecos = [];

try {
    $clienteService = new ClienteService();
    $veiculoService = new VeiculoService();
    $motoristaService = new MotoristaService();
    $encomendaService = new EncomendaService();
    $entregaService = new EntregaService();
    $rastreamentoService = new RastreamentoService();
    $enderecoService = new EnderecoService();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $acao = trim((string) ($_POST['acao'] ?? ''));

        if ($acao === 'movimentar') {
            $rastreamentoService->registrarMovimentacao((int) ($_POST['entrega_id'] ?? 0), trim((string) ($_POST['status'] ?? '')), trim((string) ($_POST['cidade'] ?? '')), trim((string) ($_POST['descricao'] ?? '')));
            $sucesso = 'Movimentação registrada com sucesso.';
        } elseif ($acao === 'criar_cliente') {
            $cliente = new Cliente(trim((string) ($_POST['nome'] ?? '')), trim((string) ($_POST['email'] ?? '')), trim((string) ($_POST['telefone'] ?? '')), trim((string) ($_POST['cpf'] ?? '')));
            $clienteService->criar($cliente);
            $sucesso = 'Cliente cadastrado com sucesso.';
            $historico[] = ['acao' => 'Cliente cadastrado', 'descricao' => trim((string) ($_POST['nome'] ?? ''))];
        } elseif ($acao === 'editar_cliente') {
            $cliente = $clienteService->buscarPorId((int) ($_POST['cliente_id'] ?? 0));
            if ($cliente) {
                $clienteAtualizado = new Cliente(trim((string) ($_POST['nome'] ?? '')), trim((string) ($_POST['email'] ?? '')), trim((string) ($_POST['telefone'] ?? '')), trim((string) ($_POST['cpf'] ?? '')));
                $clienteAtualizado->setId($cliente->getId());
                $clienteService->atualizar($clienteAtualizado);
                $sucesso = 'Cliente atualizado com sucesso.';
                $historico[] = ['acao' => 'Cliente atualizado', 'descricao' => trim((string) ($_POST['nome'] ?? ''))];
            }
        } elseif ($acao === 'remover_cliente') {
            $clienteService->deletar((int) ($_POST['id'] ?? 0));
            $sucesso = 'Cliente removido com sucesso.';
            $historico[] = ['acao' => 'Cliente removido', 'descricao' => 'ID ' . ($_POST['id'] ?? 0)];
        } elseif ($acao === 'criar_endereco') {
            $cliente = $clienteService->buscarPorId((int) ($_POST['cliente_id'] ?? 0));
            if ($cliente) {
                $endereco = new Endereco($cliente, trim((string) ($_POST['rua'] ?? '')), trim((string) ($_POST['numero'] ?? '')), trim((string) ($_POST['bairro'] ?? '')), trim((string) ($_POST['cidade'] ?? '')), trim((string) ($_POST['estado'] ?? '')), trim((string) ($_POST['cep'] ?? '')), trim((string) ($_POST['tipo'] ?? '')));
                $enderecoService->cadastrar($endereco);
                $sucesso = 'Endereço cadastrado com sucesso.';
                $historico[] = ['acao' => 'Endereço cadastrado', 'descricao' => trim((string) ($_POST['cidade'] ?? ''))];
            }
        } elseif ($acao === 'criar_veiculo') {
            $tipo = trim((string) ($_POST['tipo'] ?? 'Moto'));
            $veiculo = match ($tipo) {
                'Van' => new Van(trim((string) ($_POST['placa'] ?? '')), trim((string) ($_POST['modelo'] ?? '')), trim((string) ($_POST['cor'] ?? '')), (int) ($_POST['ano'] ?? 0)),
                'Caminhao' => new Caminhao(trim((string) ($_POST['placa'] ?? '')), trim((string) ($_POST['modelo'] ?? '')), trim((string) ($_POST['cor'] ?? '')), (int) ($_POST['ano'] ?? 0)),
                default => new Moto(trim((string) ($_POST['placa'] ?? '')), trim((string) ($_POST['modelo'] ?? '')), trim((string) ($_POST['cor'] ?? '')), (int) ($_POST['ano'] ?? 0)),
            };
            $veiculoService->cadastrar($veiculo);
            $sucesso = 'Veículo cadastrado com sucesso.';
            $historico[] = ['acao' => 'Veículo cadastrado', 'descricao' => trim((string) ($_POST['placa'] ?? ''))];
        } elseif ($acao === 'remover_veiculo') {
            $veiculoService->remover((int) ($_POST['id'] ?? 0));
            $sucesso = 'Veículo removido com sucesso.';
            $historico[] = ['acao' => 'Veículo removido', 'descricao' => 'ID ' . ($_POST['id'] ?? 0)];
        } elseif ($acao === 'criar_motorista') {
            $motorista = new Motorista(trim((string) ($_POST['nome'] ?? '')), trim((string) ($_POST['cnh'] ?? '')), trim((string) ($_POST['cpf'] ?? '')), trim((string) ($_POST['categoria'] ?? '')));
            $motoristaService->criar($motorista);
            $sucesso = 'Motorista cadastrado com sucesso.';
            $historico[] = ['acao' => 'Motorista cadastrado', 'descricao' => trim((string) ($_POST['nome'] ?? ''))];
        } elseif ($acao === 'remover_motorista') {
            $motoristaService->deletar((int) ($_POST['id'] ?? 0));
            $sucesso = 'Motorista removido com sucesso.';
            $historico[] = ['acao' => 'Motorista removido', 'descricao' => 'ID ' . ($_POST['id'] ?? 0)];
        } elseif ($acao === 'criar_encomenda') {
            $cliente = $clienteService->buscarPorId((int) ($_POST['cliente_id'] ?? 0));
            $origem = $enderecoService->buscarPorId((int) ($_POST['origem_id'] ?? 0));
            $destino = $enderecoService->buscarPorId((int) ($_POST['destino_id'] ?? 0));
            $encomenda = new Encomenda(trim((string) ($_POST['codigo'] ?? '')), $cliente, (float) ($_POST['peso'] ?? 0), (float) ($_POST['volume'] ?? 0), $origem, $destino, (float) ($_POST['valor'] ?? 0));
            $encomendaService->cadastrar($encomenda);
            $sucesso = 'Encomenda cadastrada com sucesso.';
            $historico[] = ['acao' => 'Encomenda cadastrada', 'descricao' => trim((string) ($_POST['codigo'] ?? ''))];
        } elseif ($acao === 'remover_encomenda') {
            $encomendaService->remover((int) ($_POST['id'] ?? 0));
            $sucesso = 'Encomenda removida com sucesso.';
            $historico[] = ['acao' => 'Encomenda removida', 'descricao' => 'ID ' . ($_POST['id'] ?? 0)];
        } elseif ($acao === 'criar_entrega') {
            $encomenda = $encomendaService->buscarPorId((int) ($_POST['encomenda_id'] ?? 0));
            $motorista = $motoristaService->buscarPorId((int) ($_POST['motorista_id'] ?? 0));
            $veiculo = $veiculoService->buscarPorId((int) ($_POST['veiculo_id'] ?? 0));
            $codigo = trim((string) ($_POST['codigo'] ?? '')) !== '' ? trim((string) ($_POST['codigo'] ?? '')) : 'ENT-' . strtoupper(bin2hex(random_bytes(4)));
            $entrega = new Entrega($codigo, $encomenda, $motorista, $veiculo);
            $entregaService->criar($entrega);
            $sucesso = 'Entrega cadastrada com sucesso.';
            $historico[] = ['acao' => 'Entrega cadastrada', 'descricao' => $codigo];
        } elseif ($acao === 'remover_entrega') {
            $entregaService->deletar((int) ($_POST['id'] ?? 0));
            $sucesso = 'Entrega removida com sucesso.';
            $historico[] = ['acao' => 'Entrega removida', 'descricao' => 'ID ' . ($_POST['id'] ?? 0)];
        }
    }

    $clientes = $clienteService->listar();
    $veiculos = $veiculoService->listar();
    $motoristas = $motoristaService->listar();
    $encomendas = $encomendaService->listar();
    $entregas = $entregaService->listar();
    $rastreamentos = $rastreamentoService->listar();
    $enderecos = $enderecoService->listar();
    $historico = array_slice(array_reverse($historico), 0, 6);
} catch (Throwable $exception) {
    $erro = $exception->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Transportadora</title>
    <link rel="stylesheet" href="/assets/css/dashboard.css">
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="logo"><span>TMS</span></div>
            <nav>
                <a class="<?= active($page, 'dashboard') ?>" href="?page=dashboard">Dashboard</a>
                <a class="<?= active($page, 'clientes') ?>" href="?page=clientes">Clientes</a>
                <a class="<?= active($page, 'encomendas') ?>" href="?page=encomendas">Encomendas</a>
                <a class="<?= active($page, 'entregas') ?>" href="?page=entregas">Entregas</a>
                <a class="<?= active($page, 'veiculos') ?>" href="?page=veiculos">Veículos</a>
                <a class="<?= active($page, 'motoristas') ?>" href="?page=motoristas">Motoristas</a>
                <a class="<?= active($page, 'rastreamento') ?>" href="?page=rastreamento">Rastreamento</a>
                <a class="<?= active($page, 'configuracoes') ?>" href="?page=configuracoes">Configurações</a>
            </nav>
        </aside>
        <main>
            <?php if ($erro): ?><div class="alert error"><?= esc($erro) ?></div><?php endif; ?>
            <?php if ($sucesso): ?><div class="alert success-bg"><?= esc($sucesso) ?></div><?php endif; ?>
            <?php require __DIR__ . "/views/{$page}.php"; ?>
        </main>
    </div>
</body>
    <script src="/assets/js/app.js"></script>
</html>
