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
            <div class="logo">
                <span>TMS</span>
            </div>
            <nav>
                <a class="active" href="#">Dashboard</a>
                <a href="#">Clientes</a>
                <a href="#">Encomendas</a>
                <a href="#">Veículos</a>
                <a href="#">Motoristas</a>
                <a href="#">Rastreamento</a>
                <a href="#">Configurações</a>
            </nav>
        </aside>
        <main>
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
                    <h2>154</h2>
                </div>
                <div class="card">
                    <small>Encomendas</small>
                    <h2>327</h2>
                </div>
                <div class="card">
                    <small>Entregas</small>
                    <h2>24</h2>
                </div>
                <div class="card">
                    <small>Veículos</small>
                    <h2>18</h2>
                </div>
            </section>
            <section class="content">
                <div class="table-card">
                    <div class="title">
                        Últimas Entregas
                    </div>
                    <table>
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Destino</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>TR000254</td>
                            <td>João Silva</td>
                            <td>Joinville</td>
                            <td><span class="success">Entregue</span></td>
                        </tr>
                        <tr>
                            <td>TR000255</td>
                            <td>Maria Souza</td>
                            <td>Blumenau</td>
                            <td><span class="warning">Em trânsito</span></td>
                        </tr>
                        <tr>
                            <td>TR000256</td>
                            <td>Pedro Santos</td>
                            <td>Curitiba</td>
                            <td><span class="info">Coletada</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="side">
                    <div class="widget">
                        <h3>Frota</h3>
                        <div class="progress">
                            <div class="bar"></div>
                        </div>
                        <span>72% dos veículos em operação</span>
                    </div>
                    <div class="widget">
                        <h3>Motoristas</h3>
                        <p>🟢 Disponíveis <strong>12</strong></p>
                        <p>🟡 Em rota <strong>6</strong></p>
                        <p>🔴 Descanso <strong>2</strong></p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>