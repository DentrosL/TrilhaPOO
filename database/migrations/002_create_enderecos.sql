CREATE TABLE enderecos (
    id SERIAL PRIMARY KEY,
    cliente_id INTEGER NOT NULL,
    rua VARCHAR(150) NOT NULL,
    numero VARCHAR(20) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado CHAR(2) NOT NULL,
    cep CHAR(8) NOT NULL,
    tipo VARCHAR(30) NOT NULL,

    CONSTRAINT fk_endereco_cliente
        FOREIGN KEY (cliente_id)
        REFERENCES clientes(id)
        ON DELETE CASCADE
);