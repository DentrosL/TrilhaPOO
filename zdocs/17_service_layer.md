## O que é service layer?
> Teoria
- É uma camada responsável por concentrar as regras de negócio da aplicação.
- Ela fica entre a aplicação e o Repository.

### Fluxo
Antes:
```
Aplicação
↓
Repository
↓
Banco
```
Agora:
```
Aplicação
↓
Service
↓
Repository
↓
Banco
```
Cada camada possui uma responsabilidade.

## Responsabilidades
Model -> Representa um objeto do sistema.
```
Produto
↓
nome
preço
```
Repository -> Acessa os dados.
```sql
INSERT
SELECT
UPDATE
DELETE
```
Service -> Executa regras de negócio.

Exemplos:
- validar dados;
- calcular descontos;
- impedir operações inválidas;
- coordenar chamadas ao Repository.