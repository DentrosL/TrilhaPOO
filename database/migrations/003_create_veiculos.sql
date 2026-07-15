CREATE TABLE veiculos (
    id SERIAL PRIMARY KEY,
    tipo VARCHAR(20) NOT NULL CHECK (tipo IN ('Moto', 'Van', 'Caminhao')),
    placa VARCHAR(8) UNIQUE NOT NULL,
    modelo VARCHAR(100) NOT NULL,
    cor VARCHAR(50),
    ano INTEGER,
    capacidade_peso NUMERIC(10,2),
    capacidade_volume NUMERIC(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);