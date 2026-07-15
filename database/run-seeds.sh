#!/bin/bash
for file in seeds/*.sql
do
    echo "Executando $file"
    docker compose exec -T postgres psql -U postgres -d trilha_poo < "$file"
done

echo
echo "Seeds concluídas."