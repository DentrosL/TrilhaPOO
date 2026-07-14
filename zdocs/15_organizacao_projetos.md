## Como organizar um projeto PHP para facilitar sua manutenção e evolução?
> Teoria

### O problema
Imagine que você começou um projeto. No início ele possui apenas três arquivos.
```
├── index.php
├── Produto.php
└── Cliente.php
```
Tudo parece organizado.

Agora o projeto cresce.
```
├── Cliente.php
├── Produto.php
├── Pedido.php
├── Usuario.php
├── Animal.php
├── Pessoa.php
├── Login.php
├── Email.php
├── Banco.php
├── Categoria.php
├── ...
```
Encontrar uma classe começa a ficar difícil.<br>
Imagine um projeto com centenas de arquivos. Precisamos de uma organização.

## Separando responsabilidades
Em vez de colocar tudo na raiz do projeto, organizamos os arquivos em diretórios.

Uma estrutura simples pode ser:
```
├── public/
├── src/
├── tests/
├── vendor/
├── docker/
├── .env
├── composer.json
└── docker-compose.yml
```
### Cada pasta possui uma responsabilidade.
#### A pasta public
```
public/
└── index.php
```
- É o ponto de entrada da aplicação.
- É o único arquivo que normalmente será acessado pelo navegador.

#### A pasta src
```
src/
```
Aqui fica todo o código da aplicação. Por exemplo:
```
src/
├── Models/
├── Services/
├── Interfaces/
├── Traits/
└── Database/
```
Todo o código desenvolvido durante o projeto ficará dentro dessa pasta.

#### A pasta vendor
```
vendor/
```
É criada automaticamente pelo Composer.

Ela contém:
- bibliotecas instaladas;
- autoload;
- dependências do projeto.

Essa pasta nunca deve ser editada manualmente.

#### A pasta tests
```
tests/
```
Armazena os testes automatizados da aplicação.

Mesmo que não seja usada de inicio, é uma boa prática reservar esse espaço desde o início.

#### A pasta docker
```
docker/
```
Contém todos os arquivos relacionados ao ambiente Docker.

Exemplo:
```
docker/
└── php/
    └── Dockerfile
```
Separar esses arquivos evita que a raiz do projeto fique desorganizada.

Ao final desta etapa, nosso projeto simples possui a seguinte organização:
```
├── docker/
│   └── php/
│       └── Dockerfile
├── public/
│   └── index.php
├── src/
│   ├── Database/
│   ├── Interfaces/
│   ├── Models/
│   ├── Services/
│   └── Traits/
├── tests/
├── vendor/
├── .env
├── composer.json
├── composer.lock
├── docker-compose.yml
└── README.md
```
## Por que organizar?
Imagine que daqui a seis meses você precise alterar apenas a classe Produto.

Sem organização:
200 arquivos

Você precisará procurar manualmente.

Com organização:
```
src/
↓
Models/
↓
Produto.php
```

Encontrar qualquer arquivo leva poucos segundos.

### Organização também facilita o trabalho em equipe

Quando todos seguem a mesma estrutura:
- fica mais fácil localizar arquivos;
- novos desenvolvedores entendem o projeto rapidamente;
- conflitos diminuem;
- a manutenção se torna mais simples.