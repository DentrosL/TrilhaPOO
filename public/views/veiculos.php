<header>
    <div>
        <h1>Veículos</h1>
        <span>Gerenciamento da Frota</span>
    </div>
</header>
<section class="cards">
    <div class="card">
        <small>Total</small>
        <h2><?= count($veiculos) ?></h2>
    </div>
</section>
<section class="table-card">
    <div class="title">Adicionar veículo</div>
    <form method="post" class="inline-form">
        <input type="hidden" name="acao" value="criar_veiculo">
        <input name="placa" placeholder="Placa" required>
        <input name="modelo" placeholder="Modelo" required>
        <input name="cor" placeholder="Cor" required>
        <input name="ano" type="number" placeholder="Ano" required>
        <select name="tipo">
            <option value="Moto">Moto</option>
            <option value="Van">Van</option>
            <option value="Caminhao">Caminhão</option>
        </select>
        <button class="btn" type="submit">Adicionar</button>
    </form>
</section>
<section class="table-card">
    <div class="title">Frota</div>
    <table>
        <thead>
            <tr>
                <th>Placa</th>
                <th>Modelo</th>
                <th>Tipo</th>
                <th>Ano</th>
                <th>Capacidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($veiculos as $veiculo): ?>
                <tr>
                    <td><?= esc($veiculo->getPlaca()) ?></td>
                    <td><?= esc($veiculo->getModelo()) ?></td>
                    <td><?= esc($veiculo->getTipo()) ?></td>
                    <td><?= $veiculo->getAno() ?></td>
                    <td><?= $veiculo->getCapacidadePeso() ?> kg</td>
                    <td><div class="inline-action"><form method="post"><input type="hidden" name="acao" value="remover_veiculo"><input type="hidden" name="id" value="<?= $veiculo->getId() ?>"><button class="btn danger" type="submit">Remover</button></form></div></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
