<header>
    <div>
        <h1>Rastreamento</h1>
        <span>Acompanhamento de Entregas</span>
    </div>
</header>
<section class="cards">
    <div class="card">
        <small>Movimentações</small>
        <h2><?= count($rastreamentos) ?></h2>
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
<section class="content">
    <div class="table-card">
        <div class="title">Histórico de movimentações</div>
        <table>
            <thead>
                <tr>
                    <th>Entrega</th>
                    <th>Data</th>
                    <th>Localização</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rastreamentos as $rastreamento): ?>
                    <tr>
                        <td>#<?= $rastreamento->getEntregaId() ?></td>
                        <td><?= esc($rastreamento->getDataHora()->format('d/m/Y H:i')) ?></td>
                        <td><?= esc($rastreamento->getCidade()) ?></td>
                        <td><?= esc($rastreamento->getDescricao()) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="table-card">
        <div class="title">Registrar movimentação</div>
        <form method="post" class="movement-form">
            <input type="hidden" name="acao" value="movimentar">
            <label>Entrega
                <select name="entrega_id" required>
                    <?php foreach ($entregas as $entrega): ?>
                        <option value="<?= $entrega->getId() ?>"><?= esc($entrega->getCodigo()) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Status
                <select name="status" required>
                    <?php foreach (\App\Enums\StatusEntrega::cases() as $status): ?>
                        <option value="<?= esc($status->value) ?>"><?= esc($status->value) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Cidade
                <input name="cidade" required>
            </label>
            <label>Descrição
                <textarea name="descricao" required></textarea>
            </label>
            <button class="btn" type="submit">Registrar</button>
        </form>
    </div>
</section>
