INSERT INTO entregas
    (codigo, encomenda_id, motorista_id, veiculo_id, status, data_saida, data_prevista, data_entrega)
VALUES
    ('ENT000001', 1, 1, 1, 'Em trânsito', NOW(), NOW() + INTERVAL '1 day', NULL),
    ('ENT000002', 2, 4, 3, 'Em trânsito', NOW(), NOW() + INTERVAL '3 days', NULL),
    ('ENT000003', 3, 2, 2, 'Preparando', NULL, NULL, NULL),
    ('ENT000004', 4, 5, 3, 'Coletada', NOW(), NOW() + INTERVAL '2 days', NULL),
    ('ENT000005', 5, 3, 4, 'Entregue', NOW() - INTERVAL '3 days', NOW() - INTERVAL '2 days', NOW() - INTERVAL '2 days');