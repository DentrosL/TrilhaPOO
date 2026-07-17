<header>
    <div>
        <h1>Sistema de Gestão de Transportadora</h1>
        <span>Dashboard</span>
    </div>
    <div class="user">
        <div class="status"></div>
        Administrador
    </div>
</header>
<section class="cards">
    <div class="card">
        <small>Clientes</small>
        <h2><?= count($clientes) ?></h2>
    </div>
    <div class="card">
        <small>Encomendas</small>
        <h2><?= count($encomendas) ?></h2>
    </div>
    <div class="card">
        <small>Entregas</small>
        <h2><?= count($entregas) ?></h2>
    </div>
    <div class="card">
        <small>Veículos</small>
        <h2><?= count($veiculos) ?></h2>
    </div>
</section>
<section class="content"><div class="table-card">
    <div class="title">Últimas Entregas</div>
        <table>
            <thead>
                <tr><th>Código</th><th>Cliente</th><th>Destino</th><th>Status</th></tr>
            </thead>
            <tbody>
                <?php foreach (array_slice($entregas, 0, 5) as $entrega): ?>
                    <tr>
                        <td><?= esc($entrega->getCodigo()) ?></td>
                        <td><?= esc($entrega->getEncomenda()->getCliente()->getNome()) ?></td>
                        <td><?= esc($entrega->getEncomenda()->getDestino()->getCidade()) ?></td>
                        <td><span class="<?= classeStatus($entrega->getStatus()) ?>"><?= esc($entrega->getStatus()) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="side">
        <div class="widget">
            <h3>Frota</h3>
            <p>Veículos cadastrados <strong><?= count($veiculos) ?></strong></p>
        </div>
        <div class="widget">
            <h3>Motoristas</h3>
            <p>Disponíveis <strong><?= count(array_filter($motoristas, fn ($motorista) => $motorista->isDisponivel())) ?></strong></p>
        </div>
    </div>
</section>
