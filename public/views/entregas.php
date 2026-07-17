<header>
    <div>
        <h1>Entregas</h1>
        <span>Gerenciamento de Entregas</span>
    </div>
</header>
<section class="cards">
    <div class="card">
        <small>Total</small>
        <h2><?= count($entregas) ?></h2>
    </div>
    <div class="card">
        <small>Em trânsito</small>
        <h2><?= count(array_filter($entregas, fn ($entrega) => $entrega->getStatus() === \App\Enums\StatusEntrega::EM_TRANSITO->value)) ?></h2>
    </div>
    <div class="card">
        <small>Entregues</small>
        <h2><?= count(array_filter($entregas, fn ($entrega) => $entrega->getStatus() === \App\Enums\StatusEntrega::ENTREGUE->value)) ?></h2>
    </div>
</section>
<section class="table-card">
    <div class="title">Adicionar entrega</div>
    <form method="post" class="inline-form">
        <input type="hidden" name="acao" value="criar_entrega">
        <input name="codigo" placeholder="Código da entrega" required>
        <select name="encomenda_id" required>
            <?php foreach ($encomendas as $encomenda): ?>
                <option value="<?= $encomenda->getId() ?>"><?= esc($encomenda->getCodigo()) ?></option>
            <?php endforeach; ?>
        </select>
        <select name="motorista_id" required>
            <?php foreach ($motoristas as $motorista): ?>
                <option value="<?= $motorista->getId() ?>"><?= esc($motorista->getNome()) ?></option>
            <?php endforeach; ?>
        </select>
        <select name="veiculo_id" required>
            <?php foreach ($veiculos as $veiculo): ?>
                <option value="<?= $veiculo->getId() ?>"><?= esc($veiculo->getPlaca()) ?> - <?= esc($veiculo->getModelo()) ?></option>
            <?php endforeach; ?>
        </select>
        <button class="btn" type="submit">Adicionar</button>
    </form>
</section>
<section class="table-card">
    <div class="title">Entregas</div>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Encomenda</th>
                <th>Motorista</th>
                <th>Veículo</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entregas as $entrega): ?>
                <tr>
                    <td><?= esc($entrega->getCodigo()) ?></td>
                    <td><?= esc($entrega->getEncomenda()->getCodigo()) ?></td>
                    <td><?= esc($entrega->getMotorista()->getNome()) ?></td>
                    <td><?= esc($entrega->getVeiculo()->getPlaca()) ?></td>
                    <td><span class="<?= classeStatus($entrega->getStatus()) ?>"><?= esc($entrega->getStatus()) ?></span></td>
                    <td><div class="inline-action"><form method="post"><input type="hidden" name="acao" value="remover_entrega"><input type="hidden" name="id" value="<?= $entrega->getId() ?>"><button class="btn danger" type="submit">Remover</button></form></div></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

