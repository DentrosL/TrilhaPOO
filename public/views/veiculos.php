<header>
    <div>
        <h1>Veículos</h1>
        <span>Gerenciamento da Frota</span>
    </div>
    <button class="btn">
        + Novo Veículo
    </button>
</header>
<section class="cards">
    <div class="card">
        <small>Total</small>
        <h2>18</h2>
    </div>
    <div class="card">
        <small>Disponíveis</small>
        <h2>12</h2>
    </div>
    <div class="card">
        <small>Em Rota</small>
        <h2>5</h2>
    </div>
    <div class="card">
        <small>Manutenção</small>
        <h2>1</h2>
    </div>
</section>
<section class="table-card">
    <div class="table-header">
        <div class="title">Frota</div>
        <input class="search" placeholder="Pesquisar veículo...">
    </div>
    <table>
        <thead>
            <tr>
                <th>Placa</th>
                <th>Modelo</th>
                <th>Tipo</th>
                <th>Motorista</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ABC-1234</td>
                <td>Volvo FH</td>
                <td>Caminhão</td>
                <td>João</td>
                <td><span class="success">Disponível</span></td>
            </tr>
            <tr>
                <td>DEF-4321</td>
                <td>Mercedes Sprinter</td>
                <td>Van</td>
                <td>Pedro</td>
                <td><span class="warning">Em Rota</span></td>
            </tr>
        </tbody>
    </table>
</section>