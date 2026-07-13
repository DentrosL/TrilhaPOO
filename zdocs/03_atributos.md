## O que são atributos?
> Teoria
- Um atributo é uma característica de uma classe.
- No mundo real, uma pessoa possui diversas características.

Por exemplo:
- nome;
- idade;
- altura;
- peso.

Essas características serão representadas como atributos.

Na classe criamos nossos atributos dessa forma 
```php
class Pessoa
{
    public string $nome;
}
```
- **public** -> pode ser acessado de qualquer lugar;
- **string** -> tipo do atributo;
- **$nome**  -> nome do atributo

## Como armazenar/visualizar valores nos atributos?
Criamos um objeto:
```$pessoa = new Pessoa();```

Agora podemos armazenar valores: ```$pessoa->nome = "Maria"();```

Também podemos visualizar seus valores: ```echo $pessoa->nome();```

Sempre que quisermos acessar um atributo ou método de um objeto utilizaremos: ```->```