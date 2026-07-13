## O que é umm trait?
> Teoria

- Um mecanismo de reutilização de código;
- Permite compartilhar métodos entre várias classes, sem criar uma relação de herança;
- Como um "pacote de funcionalidades".

Para ser explicado o conceito de interface vai ser usado mais de um arquivo:
- Usuario.php
- Logger.php

### Para criar uma trait
```php
trait Logger
{
    public function registrarLog(): void
    {
        echo "Log registrado.";
    }
}
```
Sua estrutura é muito parecida com uma classe.

Visualmente: 
```
         Logger (Trait)
               │
   ┌───────────┴───────────┐
   ▼                       ▼
Usuario                 Produto
```
- A trait não cria uma hierarquia.
- Ela apenas disponibiliza funcionalidades para as classes que a utilizam.
- Elas podem possuir vários métodos
- Uma Classe pode usar várias traits

## Trait x Herança
#### Herança
Representa uma relação de especialização.
```
Pessoa
↓
Funcionário
```
Um funcionário é uma pessoa.
#### Trait
Representa apenas uma funcionalidade compartilhada.
```
Logger
↓
Usuário

Produto

Pedido
```
Nenhuma dessas classes é uma Logger. Elas apenas utilizam essa funcionalidade.

## Trait x Interface
#### Interface
Define o que uma classe deve fazer.
```php
interface Pagamento
{
    public function pagar(float $valor): void;
}
```
Não possui implementação.
#### Trait
Fornece uma implementação pronta.
```php
trait Logger
{
    public function registrarLog(): void
    {
        echo "Log registrado.";
    }
}
```
Ela entrega código reutilizável.

## Quando utilizar Traits?
Traits são úteis quando diversas classes precisam compartilhar um mesmo comportamento, mas não possuem relação de herança.

Alguns exemplos:
- registrar logs;
- gerar identificadores;
- formatar datas;
- enviar notificações;
- validar informações.