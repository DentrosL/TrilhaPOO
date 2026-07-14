## O que é abstração?
> Teoria

Abstração é o processo de representar apenas as características e comportamentos essenciais, ignorando detalhes desnecessários.
- Quando modelamos um sistema, não precisamos representar tudo.
- Representamos apenas aquilo que faz sentido para o problema que estamos resolvendo.

#### Um exemplo do mundo real
Imagine um carro. Na vida real ele possui:
- cor
- modelo
- motor
- rodas
- peso

...<br>
Mas, em um sistema de locação de veículos, talvez precisemos apenas de:
- modelo
- placa
- disponibilidade

Todo o restante pode ser ignorado. Isso é abstração.

## Classes abstratas
Em PHP existe um tipo especial de classe.<br>
Ela é chamada de classe abstrata.
```php
abstract class Pessoa
{ ... }
```
Essa classe serve apenas como base para outras classes. <br>
Pode criar objetos? Não.
### Qual a vantagem?
Pense que em um sistema nunca existirá uma "Pessoa" genérica.<br>
Sempre teremos:
- Cliente
- Funcionário
- Professor

Então faz sentido impedir que alguém faça: ```new Pessoa();```<br>
A classe existe apenas para compartilhar características comuns.

Exemplo:
```php
abstract class Pessoa
{
    protected string $nome;
    protected int $idade;

    public function __construct(
        string $nome,
        int $idade
    ) {
        $this->nome = $nome;
        $this->idade = $idade;
    }
}
```
Depois:
```php
class Cliente extends Pessoa
{...}
class Funcionario extends Pessoa
{...}
```
É possivel criar: 
```php
$cliente = new Cliente("Maria", 30);
$funcionario = new Funcionario("João", 28);
```
Mas nunca: ```new Pessoa();```

## Métodos abstratos
Uma classe abstrata também pode definir métodos que ainda não possuem implementação.

Exemplo:
```php
abstract class Pessoa
{
    abstract public function apresentar(): void;
}
```
Observe que não existe corpo.
```php
    abstract public function apresentar(): void;
```
Apenas a assinatura.
### Quem implementa?
As classes filhas.
```php
class Cliente extends Pessoa
{
    public function apresentar(): void
    {
        echo "Sou um cliente.";
    }
}
```
```php
class Funcionario extends Pessoa
{
    public function apresentar(): void
    {
        echo "Sou um funcionário.";
    }
}
```
Agora todas as classes derivadas são obrigadas a implementar esse método.

Visualmente:
```
       Pessoa (abstrata)
       ─────────────────
            nome
            idade

          apresentar()
               ▲
      ┌────────┴────────┐
      ▼                 ▼
   Cliente         Funcionário
 apresentar()      apresentar()
```
## Quando utilizar?

Uma classe abstrata faz sentido quando:
- existe um conceito genérico;
- ele nunca será utilizado diretamente;
- outras classes compartilham características comuns.

Normalmente não criamos objetos dessas classes. Criamos objetos das especializações.

## Abstração x Herança
É comum confundir esses conceitos.
- **Herança** -> Permite reutilizar código.
- **Abstração** -> Define uma base comum que não pode ser utilizada diretamente.

Toda classe abstrata pode participar de uma herança. Mas nem toda herança precisa utilizar abstração.