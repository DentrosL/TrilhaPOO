## "modelagem" + relacionamentos

```
Cliente
│
├── id
├── nome
├── email
├── telefone
├── cpf
└── enderecos[]

Endereco
│
├── rua
├── numero
├── bairro
├── cidade
├── estado
├── cep
└── tipo

Motorista
│
├── nome
├── cpf
├── cnh
├── categoria
├── disponivel
└── encomendas[]

Veiculo
│
├── placa
├── modelo
├── cor
├── ano
├── capacidadePeso
└── capacidadeVolume

↓

Caminhao
Van
Moto

↓

Encomenda
│
├── codigo
├── cliente
├── peso
├── volume
├── origem
├── destino
└── valor

↓

Entrega
│
├── codigo
├── encomenda
├── motorista
├── veiculo
├── status
└── rastreamentos[]

↓

Rastreamento
│
├── cidade
├── descricao
└── dataHora
```

### Obso sobre os ids

Como o projeto vai usar PostgreSQL, vou colocar um id (int) em todas as entidades persistidas (Cliente, Endereco, Motorista, Veiculo, Encomenda, Entrega e Rastreamento), mesmo que no começo ainda não esteja salvando no banco. Isso facilita bastante a implementação dos repositórios e deixa a modelagem alinhada com a estrutura que será usada na camada de persistência.

```+``` O codigo da encomenda e da entrega continua existindo como identificador de negócio (ex.: TR000254), enquanto o id fica como chave primária técnica.

```
Cliente
    │
    ├──< Endereco
    │
    └──< Encomenda

Motorista
    │
    └──< Entrega

Veiculo
    │
    └──< Entrega

Encomenda
    │
    └─── Entrega

Entrega
    │
    └──< Rastreamento
```