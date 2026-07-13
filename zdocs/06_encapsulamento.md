## O que é o encapsulamento?
> Teoria

- Encapsulamento é o princípio de proteger os dados de um objeto, permitindo que eles sejam acessados ou alterados apenas de maneira controlada.
- Em vez de permitir acesso direto aos atributos, fazemos isso por meio de métodos.

### Visibilidade
PHP possui três níveis de visibilidade.

| Visibilidade | Quem pode acessar? |
| :---: | :---: |
| public | Qualquer lugar |
| protected | A própria classe e suas subclasses |
| private | Apenas a própria classe |

## Getters e Setters
#### Getters
É um método responsável por retornar um atributo.
```php
public function getNome(): string
{
    return $this->nome;
}
```
Ele apenas devolve a informação.

#### Setters
Para alterar um atributo criamos um Setter.
```php
public function setNome(string $nome): void
{
    $this->nome = $nome;
}
```
Agora:
```php
$pessoa->setNome("Maria");
```
Altera a informação.

## Vantagens?
Imagine um o uso para idade.

Sem encapsulamento:
```php
$pessoa->idade = -100;
```
Nada impede isso.

Com encapsulamento:
```php
public function setIdade(int $idade): void
{
    if ($idade < 0) {
        echo "Idade inválida.";
        return;
    }

    $this->idade = $idade;
}
```
Agora:
```php
$pessoa->setIdade(-100);
```
Resultado:
```bash
Idade inválida.
```
O objeto continua consistente.

## Observação
- Encapsular não significa esconder
- Muitas pessoas pensam que encapsulamento significa apenas colocar private. Não é isso.
- O verdadeiro objetivo é controlar como os dados podem ser utilizados.
- Um atributo pode ser privado e ainda assim ser acessado através de métodos públicos.