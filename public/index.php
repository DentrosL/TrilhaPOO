<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$checklist = [
    'Docker',
    'PHP 8.4',
    'PostgreSQL',
    'Composer',
    'Autoload (PSR-4)',
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trilha POO | Sistema de Gestão de Transportadora</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <header>
        <div class="container navbar">
            <div>
                <span class="badge">Projeto Final</span>
                <h1>Sistema de Gestão de Transportadora</h1>
                <p>
                    Projeto desenvolvido durante a trilha de Programação Orientada a Objetos
                    utilizando PHP, PostgreSQL, Docker e Composer.
                </p>
            </div>
            <div class="status">
                <span class="dot"></span>
                Ambiente Online
            </div>
        </div>
    </header>
    <main class="container">
        <section class="hero">
            <div class="hero-text">
                <h2>Bem-vindo à Trilha POO</h2>
                <p>
                    Este projeto reúne todos os conceitos estudados ao longo da trilha,
                    aplicando Programação Orientada a Objetos em uma aplicação completa.
                </p>
                <div class="buttons">
                    <a href="./dashboard.php" class="btn secondary">Sistema</a>
                    <a href="#" class="btn primary">Documentação</a>
                    <a href="https://github.com/DentrosL/TrilhaPOO" class="btn">GitHub</a>
                </div>
            </div>
            <div class="hero-card">
                <h3>Status do Projeto</h3>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
                <small>Estrutura inicial concluída.</small>
            </div>
        </section>
        <section class="grid">
            <div class="card">
                <h3>Ambiente</h3>
                <ul>
                    <?php foreach ($checklist as $item): ?>
                        <li><?= $item ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="card">
                <h3>Arquitetura</h3>
                <div class="tags">
                    <span>POO</span>
                    <span>Repository</span>
                    <span>Service</span>
                    <span>PDO</span>
                    <span>Docker</span>
                    <span>PostgreSQL</span>
                </div>
            </div>
            <div class="card">
                <h3>Conteúdo</h3>
                <ul>
                    <li>Classes</li>
                    <li>Herança</li>
                    <li>Interfaces</li>
                    <li>Traits</li>
                    <li>Repository Pattern</li>
                    <li>Service Layer</li>
                </ul>
            </div>
            <div class="card">
                <h3>Objetivo</h3>
                <p>
                    Desenvolver um sistema completo de gestão de transportadora
                    utilizando boas práticas de desenvolvimento e arquitetura em PHP.
                </p>
            </div>
        </section>
    </main>
    <footer>
        Desenvolvido para fins de estudo • Trilha POO
    </footer>
</body>
</html>