## O que é uma interface?
> Teoria

Uma interface é um **contrato**. 
- Ela define quais métodos uma classe deve possuir, mas não informa como eles serão implementados.

Em outras palavras:
- A interface diz o que deve ser feito.
- A classe decide como fazer.

Para ser explicado o conceito de interface vai ser usado mais de um arquivo:
- Usuario.php
- Autenticavel.php

### Para criar uma interface
```php
interface Autenticavel
{
    public function autenticar(string $senha): bool;
}
```
- não existem atributos;
- não existe implementação;
- apenas a assinatura do método.

Depois de criada você implementa a interface em uma classe:
```php
class Usuario implements Autenticavel
{
    public function autenticar(string $senha): bool
    {
        return $senha === "123456";
    }
}
```
e essa classe é obrigada a ter o método autenticar, caso contrário:

> Fatal error
> Class Usuario contains 1 abstract method and must therefore be declared abstract or implement the remaining methods.

O PHP impede que a classe seja criada. Isso garante que o contrato seja respeitado.

## Outro exemplo
Um sistema de pagamentos.
```php
interface Pagamento
{
    public function pagar(float $valor): void;
}
```
Agora podemos ter diversas formas de pagamento.
```php
class CartaoCredito implements Pagamento
{
    public function pagar(float $valor): void
    {
        echo "Pagamento realizado com cartão.";
    }
}
class Pix implements Pagamento
{
    public function pagar(float $valor): void
    {
        echo "Pagamento realizado via Pix.";
    }
}
class Boleto implements Pagamento
{
    public function pagar(float $valor): void
    {
        echo "Pagamento realizado com boleto.";
    }
}
```
Perceba que todas possuem o método: ```pagar()```<br>
Mas cada uma implementa esse método de maneira diferente.

### Interface + Polimorfismo
Como todas implementam a mesma interface, podemos trabalhar com todas da mesma forma.
```php
$pagamentos = [
    new Pix(),
    new CartaoCredito(),
    new Boleto()
];

foreach ($pagamentos as $pagamento) {
    $pagamento->pagar(100);
}
```
Resultado:
```log
Pagamento realizado via Pix.
Pagamento realizado com cartão.
Pagamento realizado com boleto.
```
O código não precisa saber qual é a classe concreta. 
Ele sabe apenas que todos seguem o contrato da interface.

## Interface x Classe Abstrata
É comum confundir esses conceitos.

#### Classe abstrata
Pode possuir:
- atributos;
- construtor;
- métodos implementados;
- métodos abstratos.
```php
abstract class Pessoa
{
    protected string $nome;

    public function apresentar(): void
    {
        echo $this->nome;
    }
}
```
#### Interface
Possui apenas o contrato.
```php
interface Pagamento
{
    public function pagar(float $valor): void;
}
```
Ela não armazena estado. Ela apenas define quais métodos devem existir.

Uma classe pode implementar várias interfaces

Uma limitação da herança é que uma classe só pode herdar de uma outra classe.