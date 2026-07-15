#!/bin/bash
SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"

for file in "$SCRIPT_DIR"/seeds/*.sql
do
    echo "Executando $(basename "$file")"
    docker compose exec -T postgres psql -U postgres -d trilha_poo < "$file"
done

echo "Seeds concluídas."