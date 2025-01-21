<?php

class FilmsRepository
{
    private PDO $pdo;
    private Logger $logger;

    public function __construct(
        PDO $pdo,
        Logger $logger
    ) {
        $this->pdo = $pdo;
        $this->logger = $logger;
    }

    public function find_film_by_id($id): array
    {
        $pdo = $this->pdo;

        $execute = function () use ($pdo, $id): array {
            $query = 'SELECT id FROM Film WHERE id = :id';

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll();

            return $result;
        };

        try {
            $this->logger->register('INFO', 'DB', 'Buscando filme pelo id...');
            $this->logger->register('DEBUG', 'DB', 'Input: \n\n' . json_encode(['id' => $id]));

            return $execute();
        } catch (\Exception $e) {
            $this->logger->register('ERROR', 'DB', 'Erro no banco de dados');
            $this->logger->register('ERROR', 'DB', 'Input: \n\n' . json_encode(['id' => $id]));
            $this->logger->register('ERROR', 'DB', "Message: \n\n" . $e->getMessage());
            $this->logger->register('ERROR', 'DB', "Trace: \n\n" . json_encode($e->getTrace()));

            throw $e;
        }
    }

    public function create_film($film): void
    {
        $pdo = $this->pdo;

        $execute = function () use ($pdo, $film) {
            $query = 'INSERT INTO Film (id, name) VALUES (:id, :name)';

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $film['id']);
            $stmt->bindParam(':name', $film['name']);
            $stmt->execute();
        };

        try {
            $this->logger->register('INFO', 'DB', 'Criando filme...');
            $this->logger->register('DEBUG', 'DB', 'Input: \n\n' . json_encode(['film' => $film]));

            $execute();
        } catch (\Exception $e) {
            $this->logger->register('ERROR', 'DB', 'Erro no banco de dados');
            $this->logger->register('ERROR', 'DB', 'Input: \n\n' . json_encode(['film' => $film]));
            $this->logger->register('ERROR', 'DB', "Message: \n\n" . $e->getMessage());
            $this->logger->register('ERROR', 'DB', "Trace: \n\n" . json_encode($e->getTrace()));

            throw $e;
        }
    }
}
