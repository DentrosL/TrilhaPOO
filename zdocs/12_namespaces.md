## O que é um namespace?
> Teoria

Um namespace = espaço de nomes.
- Ele funciona como um endereço para uma classe.
- Em vez de identificar uma classe apenas pelo seu nome, passamos a identificá-la pelo seu caminho completo.

### Para criar um namespace
```
src/
└── Models/
    └── Produto.php
```
A classe ficará assim:
```php
namespace App\Models;

class Produto
{}
```
### Outro exemplo
```
src/
└── Services/
    └── Produto.php
```
```php
namespace App\Services;

class Produto
{}
```
Temos duas classes chamadas Produto. Mas elas pertencem a namespaces diferentes.

Visualmente:
```
App\Models\Produto
App\Services\Produto
```
Os nomes são iguais. O endereço é diferente.

deixando as importações melhores:
```php
use App\Models\Produto;

$produto = new Produto();
```
Agora não precisamos escrever o namespace completo toda vez.
- podemos importar várias classes;
- mesmo que elas tenham o mesmo nome, vão estar em lugares diferentes;
- geralmente os projetos são arrumados +- assim:
```
src/
│
├── Models/
├── Services/
├── Repositories/
├── Controllers/
├── DTOs/
├── Exceptions/
├── Traits/
├── Interfaces/
└── Helpers/
```
- e o uso de namespaces facilita muito.

## Namespace e diretórios
Existe uma convenção muito importante: o namespace normalmente acompanha a estrutura de pastas.
```
src/
└── Models/
    └── Produto.php

namespace App\Models;
```
```
src/
└── Services/
    └── UsuarioService.php
namespace App\Services;
```
Isso facilita localizar qualquer classe no projeto.