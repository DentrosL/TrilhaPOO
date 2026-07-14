## Objetivo
Aplicar todos os conceitos estudados até aqui através de desafios progressivos.

Durante os exercícios você utilizará:
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
- Autoload
- Organização do projeto
- Repository Pattern
- Service Layer

# Exercício 1 - Biblioteca
Crie um sistema simples para representar livros.

### Requisitos
Crie uma classe:
- Livro

Com os atributos:
- título
- autor
- ano
- disponível

Todos devem ser privados.

Implemente:
- __construct()
- getters
- setters

Crie o método:
- emprestar() ->
que altera o livro para indisponível.

Crie:
- devolver() ->
que torna o livro disponível novamente.

#### Conceitos utilizados
- Classes
- Objetos
- Encapsulamento
- Métodos
- Construtores

## Exercício 2 - Funcionários
Praticar herança.

Crie a classe abstrata:
- Funcionario

Com:
- nome
- salário

Método abstrato:
- calcularBonus()

Depois crie:
- Gerente
- Desenvolvedor
- Estagiario

Cada um calcula um bônus diferente.

Exemplo:
Gerente

- 20% - Desenvolvedor
- 10% - Estagiário
- 5% - 

#### Conceitos utilizados
- Herança
- Abstração
- Polimorfismo

## Exercício 3 - Sistema de Pagamentos
Crie a interface:
- Pagamento

Método:
- pagar(float $valor)

Implemente:
- Pix
- Cartão
- Boleto

Cada um deve imprimir uma mensagem diferente.

Percorra um array.
- foreach (...)

Chamando:
- pagar()

#### Conceitos utilizados
- Interface
- Polimorfismo

## Exercício 4 - Logger
Crie uma trait.
- Logger

Método:
- registrarLog()

Utilize essa trait nas classes:
- Usuario
- Produto
- Pedido

#### Conceitos utilizados
Traits

## Exercício 5 - Organização do projeto
Organize seu projeto.
```
src/
Models/
Repositories/
Services/
Traits/
Interfaces/
```
Configure corretamente todos os namespaces.

Teste o autoload.

Nenhum require deve existir além do:
```
vendor/autoload.php
```

#### Conceitos utilizados
- Namespace
- Composer
- PSR-4
- Organização

## Exercício 6 - Repository
Crie:
- ProdutoRepository

Implemente:
- salvar()
- buscarTodos()
- buscarPorId()
- atualizar()
- remover()

Por enquanto cada método pode apenas imprimir uma mensagem.

#### Conceitos utilizados
- Repository Pattern

## Exercício 7 - Service
Crie:
- ProdutoService

Antes de salvar um produto, valide:
- nome obrigatório
- preço maior que zero

Depois chame:
- ProdutoRepository
- Conceitos utilizados
- Service Layer
- Repository

## Desafio simples
Sistema de Biblioteca

Agora é hora de juntar tudo.

Você deverá desenvolver uma pequena aplicação orientada a objetos utilizando todos os conceitos estudados.

Estrutura
```
src/
├── Models/
│   ├── Livro.php
│   ├── Usuario.php
│   └── Emprestimo.php
│
├── Repositories/
│   ├── LivroRepository.php
│   └── UsuarioRepository.php
│
├── Services/
│   └── EmprestimoService.php
│
├── Interfaces/
├── Traits/
└── Database/
```
Regras

Implemente as classes:
- Livro
- Usuario
- Emprestimo

Utilize:
- atributos privados;
- construtores;
- getters e setters;
- namespaces;
- autoload.

Crie um Logger utilizando Trait.

Crie uma interface:
- Identificavel

Com:
- getId()

Faça Livro e Usuario implementarem essa interface.

Crie um:
- LivroRepository

Responsável apenas por persistência.

Crie um:
- EmprestimoService

Responsável pelas regras:
- verificar disponibilidade do livro;
- realizar empréstimo;
- devolver livro;
- registrar logs.
- Resultado esperado

> Ao concluir este desafio, terá construído uma pequena aplicação em PHP aplicando praticamente todos os conceitos vistos na trilha. Mais importante do que o código funcionar é conseguir justificar por que cada classe existe, qual é sua responsabilidade e como elas colaboram entre si. Essa é a essência da Programação Orientada a Objetos e prepara o terreno para integrar essas classes ao PostgreSQL e transformar a aplicação em um sistema persistente.