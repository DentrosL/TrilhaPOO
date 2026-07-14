## Configuração do ambiente para postgreSQL
> Teoria

### O papel do Docker
Nosso banco de dados não está instalado diretamente no computador.Ele está sendo executado dentro de um container Docker.<br>
Nossa aplicação PHP também roda em um container.
Assim, todo o ambiente do projeto fica isolado e pode ser executado em qualquer computador.

### O arquivo ```.env```
Mesmo utilizando Docker, algumas informações do projeto podem mudar entre ambientes.

Por exemplo:
- nome do banco;
- usuário;
- senha;
- porta.

Por isso utilizamos um arquivo chamado: ```.env```<br>
Ele concentra todas as configurações da aplicação em um único lugar.

#### Criando o arquivo
Na raiz do projeto, ele terá o seguinte conteúdo:
```env
DB_CONNECTION=pgsql
DB_HOST=localhost/postgres/url
DB_PORT=5432
DB_DATABASE=seu_banco
DB_USERNAME=user_banco
DB_PASSWORD=senha_banco
```
- DB_CONNECTION -> Define qual banco será utilizado.
- DB_HOST -> Este valor não é o IP do banco. É o nome do serviço definido no docker-compose.yml.
```yaml
services:
  postgres:
```
Como os containers estão na mesma rede, eles se comunicam pelo nome do serviço.
- DB_PORT -> É a porta padrão utilizada pelo PostgreSQL.
- DB_DATABASE -> Nome do banco criado pelo Docker.
- DB_USERNAME -> Usuário utilizado para acessar o banco.
- DB_PASSWORD -> Senha do usuário.

### Relação com o Docker
Essas informações devem ser iguais às configuradas no docker-compose.yml.
Exemplo:
```yaml
postgres:
  image: postgres:17

  environment:
    POSTGRES_DB: seu_banco
    POSTGRES_USER: user_banco
    POSTGRES_PASSWORD: senha_banco
```
Perceba que os valores correspondem ao conteúdo do .env.

## Por que utilizar um ```.env```?
Imagine que outro desenvolvedor clone o projeto.

Ele poderá alterar apenas o arquivo ```.env``` sem precisar modificar o código da aplicação.

Isso facilita a configuração em diferentes ambientes.