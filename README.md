# Programação Orientada a Objetos com PHP

Repositório criado para ensinar Programação Orientada a Objetos (POO) utilizando um ambiente moderno com:

- PHP 8.4
- PostgreSQL
- Docker
- Composer

O objetivo é construir o conhecimento de forma progressiva, começando pelos conceitos fundamentais da orientação a objetos até a construção de uma aplicação completa utilizando banco de dados.

## Como utilizar este repositório

Este projeto foi organizado por **branches**, permitindo acompanhar a evolução do código ao longo das etapas.

Cada branch representa uma etapa da trilha de aprendizado.

Exemplo:

- `00-ambiente`
- `01-classes`
- `02-objetos`
- `...`

A branch **main** contém o projeto completo ao final da trilha.

## Conteúdo

> Em desenvolvimento.

A trilha será construída passo a passo, incluindo:

- Preparação do ambiente
- Docker e Composer
- Classes
- Objetos
- Atributos
- Métodos
- Construtores
- Encapsulamento
- Herança
- Polimorfismo
- Abstração
- Interfaces
- Traits
- Namespaces
- Autoload com Composer
- Conexão com PostgreSQL
- Organização de projetos
- Repository Pattern
- Service Layer
- Exercícios práticos
- Projeto final

## Requisitos

- Docker Desktop ou Docker Engine
- Docker Compose

Após clonar o repositório:

```bash
docker compose up --build -d
```

A aplicação ficará disponível em:

```
http://localhost:8000
```

Projeto desenvolvido para fins de estudo e ensino de POO utilizando PHP puro.

## Sistema de transportadora

O sistema está organizado em três camadas:

- `Models`: representam os dados e comportamentos do domínio.
- `Repositories`: concentram a persistência com PostgreSQL.
- `Services`: aplicam validações e regras de negócio antes de acessar os repositórios.

O painel em `http://localhost:8000/home.php` consome os services para exibir clientes, encomendas, entregas, veículos, motoristas e rastreamentos cadastrados no banco.

Na tela de Rastreamento, o formulário registra uma movimentação com cidade e descrição. A operação atualiza o status da entrega, cria o item no histórico e escreve o evento no log da aplicação.

### Testes

Com os containers em execução, valide o projeto com:

```bash
docker compose exec php composer test
```

Os testes de integração inserem dados em uma transação e executam rollback ao final. Assim, criações, atualizações, alterações de status e registros de rastreamento são validados sem modificar os dados do ambiente.

Para executar apenas uma categoria:

```bash
docker compose exec php composer test:basic
docker compose exec php composer test:integration
docker compose exec php composer test:http
```
