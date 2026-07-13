## O que é um método?
> Teoria
- Um método é uma ação ou comportamento de uma classe.
- Enquanto os atributos representam características, os métodos representam aquilo que o objeto pode fazer.

Podemos resumir assim:

| Atributos | Métodos |
| :---: | :---: |
| O que o objeto **é** | O que o objeto **faz** |
| Nome | Falar |
| Altura | Caminhar |
| Idade | Dormir |

Na classe criamos nossos métodos dessa forma 
```php
class Pessoa
{
    public function apresentar()
    {
        echo "Meu nome é " . $this->nome;
    }
}
```
Por convenção é geralmente usado para os nomes:
- camelCase;
- verbos.

## Como um método é chamado/usado?
```php
$pessoa->apresentar();
```
### O que é $this?
```$this``` representa o próprio objeto.

Sempre que um método precisar acessar um atributo do próprio objeto, utilizaremos $this.

```$pessoa -> Objeto Pessoa -> $this```

### Exemplo
```php
class Produto
{
    public string $nome;
    public float $preco;

    public function exibirInformacoes()
    {
        echo "Produto: " . $this->nome . PHP_EOL;
        echo "Preço: R$ " . $this->preco;
    }
}
```
Usando:
```php
$produto = new Produto();

$produto->nome = "Notebook";
$produto->preco = 4500.00;

$produto->exibirInformacoes();
```
Resultado:

```bash
Produto: Notebook
Preço: R$ 4500
```