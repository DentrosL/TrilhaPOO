#!/usr/bin/env bash

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

for file in "$SCRIPT_DIR"/migrations/*.sql; do
    echo "Executando $(basename "$file")"
    docker compose exec -T postgres psql -U postgres -d trilha_poo < "$file"
done

echo "Migrations concluídas."