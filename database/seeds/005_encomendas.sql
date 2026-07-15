INSERT INTO encomendas
    (codigo, cliente_id, origem_id, destino_id, peso, volume, valor, status)
VALUES
    ('ENC000001',1,1,2,8.5,0.20,150.00,'Coletada'),
    ('ENC000002',2,3,4,950,5.80,1800.00,'Em trânsito'),
    ('ENC000003',3,4,5,28,0.50,220.00,'Separação'),
    ('ENC000004',4,5,6,1800,12.30,5400.00,'Coletada'),
    ('ENC000005',5,6,1,12,0.25,95.00,'Entregue');