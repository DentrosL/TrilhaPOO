## O que é o autoload?
> Teoria

O Autoload é um mecanismo que carrega automaticamente uma classe quando ela é utilizada.

Em vez de escrever:
```require_once 'Produto.php';```<br>
Basta utilizar:
```new Produto();```<br>
O Composer localizará o arquivo automaticamente.

Para ser explicado o conceito do autoload vai ser usado mais de um arquivo:
- Produto.php
- index.php

### O papel do Composer

Além de gerenciar dependências, o Composer também é responsável pelo autoload. É ele quem cria um carregador automático para todas as classes do projeto.

#### Configurando o composer.json

No arquivo **composer.json** adicionamos:
```json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```
O que isso significa?
```
App\
 ↓
src/
```
Toda classe que começar com: ```App\```<br>
será procurada dentro da pasta: ```src/```

Fluxo visual:
```
new Produto()
    ↓
Composer
    ↓
Procura o namespace
    ↓
Encontra o arquivo
    ↓
Carrega automaticamente
    ↓
Objeto criado
```