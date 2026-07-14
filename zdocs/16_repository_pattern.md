## O que é o Repository Pattern?
O Repository Pattern é um padrão de projeto que separa o acesso aos dados da lógica da aplicação.
- Em vez de a classe acessar o banco diretamente, criamos uma classe especializada nisso.

Para ser explicado o conceito de interface vai ser usado mais de um arquivo:
- Produto.php
- ProdutoRepository.php

Antes
```
Produto
↓
Banco de Dados
```
A classe faz tudo.

Depois
```
Produto
↓
ProdutoRepository
↓
Banco de Dados
```
Agora cada classe possui apenas uma responsabilidade.

### Cada classe possui uma responsabilidade
```
Produto
↓
Representa um produto
```
```
ProdutoRepository
↓
Salva produtos
Busca produtos
Atualiza produtos
Remove produtos
```
### Métodos comuns
É comum encontrarmos métodos como:
```php
class ProdutoRepository
{
    public function salvar() {}
    public function buscarPorId() {}
    public function buscarTodos() {}
    public function atualizar() {}
    public function remover() {}
}
```
Perceba que todos possuem relação apenas com persistência de dados.

## Vantagens
Separando responsabilidades conseguimos:
- código mais organizado;
- classes menores;
- manutenção mais simples;
- facilidade para testar;
- reutilização.

## Repository não é o banco
Uma dúvida comum. O Repository não substitui o PostgreSQL. Ele também não substitui o PDO.

O fluxo é:
```
Aplicação
↓
Repository
↓
PDO
↓
PostgreSQL
```
Cada camada possui sua responsabilidade.