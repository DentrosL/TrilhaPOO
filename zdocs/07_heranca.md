## O que é herança?
> Teoria

Herança é o mecanismo que permite que uma classe herde características e comportamentos de outra classe.
- Em vez de duplicar código, criamos uma classe mais genérica;
- Depois fazemos outras classes aproveitarem essa implementação.

Temos a classe pai - que será a inicial/principal - e depois teremos classes filhas, classes que se extenderão da pai
#### Exemplo:
Classe pai: 
- Ela representa qualquer pessoa.
```php
class Pessoa
{
    protected string $nome;
    protected int $idade;

    public function __construct(string $nome, int $idade)
    {
        $this->nome = $nome;
        $this->idade = $idade;
    }

    public function apresentar(): void
    {
        echo "Meu nome é {$this->nome}.";
    }
}
```
Classe filha

```php
class Funcionario extends Pessoa
{
    protected float $salario;
}
```

### O que foi herdado?
Mesmo sem declarar nada, Funcionario já possui:
- nome;
- idade;
- apresentar().

Visualmente:
```
Pessoa
├── nome
├── idade
└── apresentar()
        ▲
        │
Funcionario
```

#### Adicionando novos atributos
Cada classe filha pode possuir suas próprias características.
<br>Como no exemplo a cima o funcionário possui:
- nome
- idade
- salário * vinda de funcionário

#### Utilizando o construtor

Como Funcionario possui um novo atributo, criamos seu próprio construtor.
```php
class Funcionario extends Pessoa
{
    protected float $salario;

    public function __construct(
        string $nome,
        int $idade,
        float $salario
    ) {
        parent::__construct($nome, $idade); // parent::__construct significa = execute o construtor da classe pai.

        $this->salario = $salario;
    }
}
```