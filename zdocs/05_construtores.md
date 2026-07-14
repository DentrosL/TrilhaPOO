## O que é um construtor?
> Teoria

Esse é um dos pontos mais importantes da POO. Até agora mostrei como criar um objeto e depois precisa preencher atributo por atributo. O construtor resolve exatamente esse problema.
- O construtor é um método especial executado **automaticamente** quando um objeto é criado.
- Ele é utilizado para inicializar um objeto.

Em outras palavras: O construtor prepara o objeto para ser utilizado.

Fluxo de criação:
```php
new Pessoa("Roberto")
        │
        ▼
    __construct()
        │
        ▼
$this->nome = "Roberto"
        │
        ▼
Objeto pronto
```