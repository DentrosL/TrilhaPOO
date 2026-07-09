# Docker
## Passo 1

Criar o ```docker-compose.yml``` na raíz do projeto.

## Passo 2

Criar o Dockerfile do PHP.
```
docker/
└── php/
    └── Dockerfile
```

### Imagem
- É um modelo pronto para criar containers. É a receita do bolo.
- Ela contém tudo o que um software precisa para funcionar.

### Build
- Significa construir uma imagem personalizada.
- Quando a imagem pronta não atende às suas necessidades, criamos um Dockerfile.

### Container
- O container é uma instância em execução de uma imagem.
- Se a imagem é a receita, o container é o bolo pronto.

### Volume
- Um container pode ser apagado a qualquer momento.
- Se os arquivos estivessem apenas dentro dele, tudo seria perdido.
- O volume serve para persistir dados.

## Passo 3

Criar a configuração do PostgreSQL.
```
docker/
└── postgres/
```
Podemos colocar depois um ```init.sql```

para criar tabelas automaticamente quando chegar a parte do banco.

## Passo 4

Subir os containers ```docker compose up -d```

### up
Cria e inicia os containers. ```docker compose up```

### down
Para e remove os containers. ```docker compose down```

### ps
Lista os containers do projeto. ```docker compose ps```

### logs
Mostra tudo o que um container escreveu no terminal. ```docker compose logs```

### exec
Executa um comando dentro de um container que já está rodando. ```docker compose exec php bash```

## Passo 5

Verificar versões
```bash
php -v
composer -V
psql --version
```

# Composer

Instalar o Composer ```composer init```