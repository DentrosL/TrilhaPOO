# Database

Esta pasta contém toda a estrutura do banco de dados do projeto.

## Estrutura

```text
database/
├── migrations/
├── seeds/
├── run-migrations.sh
├── run-seeds.sh
└── README.md
```

## Migrations
Responsáveis por criar todas as tabelas do banco.

Para executar todas as migrations:

```bash
./database/run-migrations.sh
```

## Seeds
Populam o banco com dados de exemplo.

Para executar:

```bash
./database/run-seeds.sh
```

## Ordem de execução
1. Suba os containers

```bash
docker compose up -d
```

2. Execute as migrations

```bash
./database/run-migrations.sh
```

3. Execute os seeds

```bash
./database/run-seeds.sh
```

## Banco utilizado
- PostgreSQL 17

## Observação
Os scripts utilizam o container PostgreSQL definido no `docker-compose.yml`. Caso o nome do serviço ou do banco seja alterado, ajuste os scripts `run-migrations.sh` e `run-seeds.sh`.