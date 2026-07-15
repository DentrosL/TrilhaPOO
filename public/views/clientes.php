<header>
    <div>
        <h1>Clientes</h1>
        <span>Gerenciamento de Clientes</span>
    </div>
    <button class="btn">
        + Novo Cliente
    </button>
</header>
<section class="cards">
    <div class="card">
        <small>Total de Clientes</small>
        <h2>154</h2>
    </div>
    <div class="card">
        <small>Pessoa Física</small>
        <h2>98</h2>
    </div>
    <div class="card">
        <small>Pessoa Jurídica</small>
        <h2>56</h2>
    </div>
    <div class="card">
        <small>Novos este mês</small>
        <h2>12</h2>
    </div>
</section>
<section class="table-card">
    <div class="table-header">
        <div class="title">
            Lista de Clientes
        </div>
        <input
            class="search"
            type="text"
            placeholder="Pesquisar cliente...">
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Documento</th>
                <th>Cidade</th>
                <th>Telefone</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>João Silva</td>
                <td>111.111.111-11</td>
                <td>Joinville</td>
                <td>(47) 99999-9999</td>
                <td><span class="success">Ativo</span></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Maria Souza</td>
                <td>22.333.444/0001-55</td>
                <td>Blumenau</td>
                <td>(47) 98888-8888</td>
                <td><span class="success">Ativo</span></td>
            </tr>
            <tr>
                <td>3</td>
                <td>Pedro Santos</td>
                <td>555.444.333-22</td>
                <td>Curitiba</td>
                <td>(41) 97777-7777</td>
                <td><span class="warning">Inativo</span></td>
            </tr>
        </tbody>
    </table>
</section>