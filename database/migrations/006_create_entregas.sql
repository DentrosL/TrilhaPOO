CREATE TABLE entregas (
    id SERIAL PRIMARY KEY,
    codigo VARCHAR(30) UNIQUE,
    encomenda_id INTEGER NOT NULL UNIQUE,
    motorista_id INTEGER NOT NULL,
    veiculo_id INTEGER NOT NULL,
    status VARCHAR(30),
    data_saida TIMESTAMP,
    data_prevista TIMESTAMP,
    data_entrega TIMESTAMP,

    FOREIGN KEY (encomenda_id)
        REFERENCES encomendas(id),
    FOREIGN KEY (motorista_id)
        REFERENCES motoristas(id),
    FOREIGN KEY (veiculo_id)
        REFERENCES veiculos(id)
);