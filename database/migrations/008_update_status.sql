UPDATE entregas
SET status = 'Aguardando'
WHERE status IS NULL;

ALTER TABLE entregas
ALTER COLUMN status SET DEFAULT 'Aguardando';

ALTER TABLE entregas
ALTER COLUMN status SET NOT NULL;
