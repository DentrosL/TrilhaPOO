<header>
    <div>
        <h1>Encomendas</h1>
        <span>Gerenciamento de Encomendas</span>
    </div>
    <button class="btn">
        + Nova Encomenda
    </button>
</header>
<section class="cards">
    <div class="card">
        <small>Total</small>
        <h2>327</h2>
    </div>
    <div class="card">
        <small>Em Transporte</small>
        <h2>48</h2>
    </div>
    <div class="card">
        <small>Entregues</small>
        <h2>251</h2>
    </div>
    <div class="card">
        <small>Canceladas</small>
        <h2>28</h2>
    </div>
</section>
<section class="table-card">
    <div class="table-header">
        <div class="title">Encomendas</div>
        <input class="search" placeholder="Pesquisar encomenda...">
    </div>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Cliente</th>
                <th>Destino</th>
                <th>Peso</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>TR000254</td>
                <td>João Silva</td>
                <td>Joinville</td>
                <td>12 kg</td>
                <td><span class="warning">Em Transporte</span></td>
            </tr>
            <tr>
                <td>TR000255</td>
                <td>Maria Souza</td>
                <td>Curitiba</td>
                <td>4 kg</td>
                <td><span class="success">Entregue</span></td>
            </tr>
        </tbody>
    </table>
</section>