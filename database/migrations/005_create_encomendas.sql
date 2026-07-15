CREATE TABLE encomendas (
    id SERIAL PRIMARY KEY AUTO_INCREMENT,
    codigo VARCHAR(30) UNIQUE NOT NULL,
    cliente_id INTEGER NOT NULL,
    origem_id INTEGER NOT NULL,
    destino_id INTEGER NOT NULL,
    peso NUMERIC(10,2) NOT NULL,
    volume NUMERIC(10,2) NOT NULL,
    valor NUMERIC(10,2),
    status VARCHAR(30),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (cliente_id)
        REFERENCES clientes(id),
    FOREIGN KEY (origem_id)
        REFERENCES enderecos(id),
    FOREIGN KEY (destino_id)
        REFERENCES enderecos(id)
);