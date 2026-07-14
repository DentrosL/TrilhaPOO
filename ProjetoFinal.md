# TMS (Transport Management System)
### Objetivo do projeto
Desenvolver um sistema para gerenciar todo o fluxo de uma transportadora, desde o cadastro de clientes até a entrega da encomenda.

## Funcionalidades
### Clientes
- Cadastrar cliente
- Editar cliente
- Remover cliente
- Buscar cliente
- Listar clientes
- Endereços

Cada cliente pode possuir vários endereços. Exemplo:
```
Cliente
    ↓
Endereço residencial
    ↓
Endereço comercial
```
### Veículos
- Cadastrar veículos.

Tipos de Veículos
- Caminhão
- Van
- Moto

Cada um possui capacidades diferentes.

### Motoristas
- Cadastrar motoristas.
- Cadastrar encomendas.
- Criar entrega.

**Informações Obrigatórias:**<br>
Sobre Motoristas:
- Nome
- CNH
- Categoria
- Disponível
- Encomendas

Sobre Encomendas:
- Cliente
- Peso
- Volume
- Endereço de origem
- Endereço de destino
- Entregas

Sobre Entregas:
- Encomenda
- Motorista
- Veículo
- Status
- Rastreamento

### Cada alteração gera um histórico.
```
Criada
    ↓
Coletada
    ↓
Centro de distribuição
    ↓
Em trânsito
    ↓
Saiu para entrega
    ↓
Entregue
```
### Banco
- clientes
- enderecos
- motoristas
- veiculos
- encomendas
- entregas
- rastreamentos

### Estrutura
```
src/
├── Models/
│       Cliente.php
│       Endereco.php
│       Veiculo.php (abstrata)
│       Caminhao.php
│       Van.php
│       Moto.php
│       Motorista.php
│       Encomenda.php
│       Entrega.php
│       Rastreamento.php
├── Repositories/
│       ClienteRepository.php
│       EnderecoRepository.php
│       MotoristaRepository.php
│       VeiculoRepository.php
│       EncomendaRepository.php
│       EntregaRepository.php
├── Services/
│       ClienteService.php
│       FreteService.php
│       EntregaService.php
│       RastreamentoService.php
│       VeiculoService.php
├── Interfaces/
│       Transportavel.php
├── Traits/
│       Logger.php
├── Exceptions/
│       VeiculoSemCapacidadeException.php
│       MotoristaIndisponivelException.php
│       EntregaFinalizadaException.php
└── Database/
        Connection.php
```
