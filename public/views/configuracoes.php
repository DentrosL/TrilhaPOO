<header>
    <div>
        <h1>Configurações</h1>
        <span>Parâmetros do Sistema</span>
    </div>
</header>
<section class="content">
    <div class="table-card">
        <div class="title">Configurações Gerais</div>
        <table>
            <tbody>
                <tr><td>Nome da Empresa</td><td>Transportadora POO</td></tr>
                <tr><td>Banco de Dados</td><td>PostgreSQL</td></tr>
                <tr><td>Versão do PHP</td><td>8.4</td></tr>
                <tr><td>Ambiente</td><td>Desenvolvimento</td></tr>
            </tbody>
        </table>
    </div>
    <div class="table-card">
        <div class="title">Histórico recente</div>
        <table>
            <tbody>
                <?php foreach ($historico as $item): ?>
                    <tr><td><?= esc($item['acao']) ?></td><td><?= esc($item['descricao']) ?></td></tr>
                <?php endforeach; ?>
                <?php if ($historico === []): ?><tr><td colspan="2">Nenhuma atividade registrada ainda.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </div>
</section>