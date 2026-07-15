CREATE TABLE rastreamentos (
    id SERIAL PRIMARY KEY AUTO_INCREMENT,
    entrega_id INTEGER NOT NULL,
    cidade VARCHAR(100),
    descricao TEXT,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (entrega_id)
        REFERENCES entregas(id)
        ON DELETE CASCADE
);