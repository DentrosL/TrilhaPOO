## O que é polimorfismo?
> Teoria

A palavra polimorfismo vem do grego.
- Poli → muitos
- Morfismo → formas

Ou seja:
- Muitas formas.

Na Programação Orientada a Objetos significa:
- Objetos diferentes podem responder de maneiras diferentes ao mesmo método.

### Questão/problema
Na herança uma classe frilha pega os métodos da classe pai... por exemplo a ```apresentar()```. <br>
Será que um cliente deveria se apresentar igual a um funcionário? Talvez não.

Um **funcionário** poderia dizer:
Olá!
Sou João e trabalho na empresa.

Enquanto um **cliente** poderia dizer:
Olá!
Sou Maria e sou cliente da empresa.
> É exatamente isso que o polimorfismo resolve.

### Sobrescrevendo um método
Na classe Funcionario:
```php
class Funcionario extends Pessoa
{
    public function apresentar(): void
    {
        echo "Olá! Meu nome é {$this->nome} e sou funcionário.";
    }
}
```
Na classe Cliente:
```php
class Cliente extends Pessoa
{
    public function apresentar(): void
    {
        echo "Olá! Meu nome é {$this->nome} e sou cliente.";
    }
}
```
Observe que:
- O método possui exatamente o mesmo nome.
- Mas cada classe implementa sua própria versão.

Visualmente:
```
                Pessoa
                   │
         apresentar()
                   │
        ┌──────────┴──────────┐
        ▼                     ▼
Cliente              Funcionário
apresentar()         apresentar()
```

## Herança x Polimorfismo
Herança responde:
- "O que essa classe é?"

Cachorro é um Animal.

Polimorfismo responde:
- "Como esse objeto executa determinada ação?"

Animal -> emitirSom()

```
Cachorro -> Au au!

Gato -> Miau!

Vaca -> Muu!
```