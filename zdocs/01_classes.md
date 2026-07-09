## O que é uma classe?
> Teoria
- É um modelo utilizado para representar algo do mundo real;
- Descreve como um objeto poderá ser, mas não cria esse objeto;
- Pode se visualizar a classe como um molde.

#### Alguns exemplos:

| Mundo real | Programação |
| :---: | :---: |
| Bolo | Objeto |
| Planta de uma casa | Classe |
| Casa construída | Objeto |
| Carro fabricado | Classe |

Uma classe apenas descreve. Ela não existe fisicamente até que um objeto seja criado.

## Primeira classe
Dentro da pasta ```src```, vai ser encontrado o arquivo ```Pessoa.php```
- vai ver que para declarar uma classe é apenas:
```php
class NomeClasse 
{...}

```
#### Detalhes
Por convenção é usado:
- PascalCase;
- Singular;
- Nome que represente aquilo que ela modela.

## O que vai pra dentro da classe?
- Stributos;
- Métodos;
- Construtores;
- Constantes.

## Analogia

Imagine que você desenhou a planta de uma casa.

```
Planta Casa
 ┌──────────────┐
 │  Sala        │
 │  Cozinha     │
 │  Quarto      │
 └──────────────┘
```
A casa já existe? 
**Não.** Você apenas definiu como ela será/o que terá.

Uma classe funciona exatamente da mesma forma.