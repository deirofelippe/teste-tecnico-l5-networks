<?php

class AuthorsRepository
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

    public function find_author_by_name(string $name): array
    {
        $pdo = $this->pdo;

        $execute = function () use ($pdo, $name): array {
            $query = 'SELECT id FROM Author WHERE name = :name';

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            $result = $stmt->fetchAll();

            return $result;
        };

        try {
            $this->logger->register('INFO', 'DB', 'Buscando author pelo name...');
            $this->logger->register('DEBUG', 'DB', 'Input: \n\n' . json_encode(['name' => $name]));

            return $execute();
        } catch (\Exception $e) {
            $this->logger->register('ERROR', 'DB', 'Erro no banco de dados');
            $this->logger->register('ERROR', 'DB', 'Input: \n\n' . json_encode(['name' => $name]));
            $this->logger->register('ERROR', 'DB', "Message: \n\n" . $e->getMessage());
            $this->logger->register('ERROR', 'DB', "Trace: \n\n" . json_encode($e->getTrace()));

            throw $e;
        }
    }

    public function create_author(array $author): void
    {
        $pdo = $this->pdo;

        $execute = function () use ($pdo, $author) {
            $query = 'INSERT INTO Author (id, name) VALUES (:id, :name)';

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $author['id']);
            $stmt->bindParam(':name', $author['name']);
            $stmt->execute();
        };

        try {
            $this->logger->register('INFO', 'DB', 'Criando author...');
            $this->logger->register('DEBUG', 'DB', 'Input: \n\n' . json_encode(['author' => $author]));

            $execute();
        } catch (\Exception $e) {
            $this->logger->register('ERROR', 'DB', 'Erro no banco de dados');
            $this->logger->register('ERROR', 'DB', 'Input: \n\n' . json_encode(['author' => $author]));
            $this->logger->register('ERROR', 'DB', "Message: \n\n" . $e->getMessage());
            $this->logger->register('ERROR', 'DB', "Trace: \n\n" . json_encode($e->getTrace()));

            throw $e;
        }
    }

    public function get_authors_and_total_comments(): array
    {
        $pdo = $this->pdo;

        $execute = function () use ($pdo): array {
            $query = <<<EOL
                SELECT a.name AS author_name, a.id AS author_id, COUNT(a.id) AS total_comments
                FROM Comment AS c
                JOIN Author AS a ON a.id = c.author_id 
                JOIN Film AS f ON f.id = c.film_id
                GROUP BY a.id
                ORDER BY a.name;
            EOL;

            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $authors = $stmt->fetchAll();

            return $authors;
        };

        try {
            $this->logger->register('INFO', 'DB', 'Criando author...');
            $this->logger->register('DEBUG', 'DB', 'Input: \n\n' . json_encode([]));

            return $execute();
        } catch (\Exception $e) {
            $this->logger->register('ERROR', 'DB', 'Erro no banco de dados');
            $this->logger->register('ERROR', 'DB', 'Input: \n\n' . json_encode([]));
            $this->logger->register('ERROR', 'DB', "Message: \n\n" . $e->getMessage());
            $this->logger->register('ERROR', 'DB', "Trace: \n\n" . json_encode($e->getTrace()));

            throw $e;
        }
    }

    public function get_details_of_authors_comments(): array
    {
        $pdo = $this->pdo;

        $execute = function () use ($pdo): array {
            $query = <<<EOL
                SELECT a.name AS author_name, f.name AS film_name, c.comment AS comment, c.created_at AS date, a.id AS author_id, f.id AS film_id
                FROM Comment AS c
                JOIN Author AS a ON a.id = c.author_id 
                JOIN Film AS f ON f.id = c.film_id
                ORDER BY a.name;
            EOL;

            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $comments_details = $stmt->fetchAll();
            return $comments_details;
        };

        try {
            $this->logger->register('INFO', 'DB', 'Criando author...');
            $this->logger->register('DEBUG', 'DB', 'Input: \n\n' . json_encode([]));

            return $execute();
        } catch (\Exception $e) {
            $this->logger->register('ERROR', 'DB', 'Erro no banco de dados');
            $this->logger->register('ERROR', 'DB', 'Input: \n\n' . json_encode([]));
            $this->logger->register('ERROR', 'DB', "Message: \n\n" . $e->getMessage());
            $this->logger->register('ERROR', 'DB', "Trace: \n\n" . json_encode($e->getTrace()));

            throw $e;
        }
    }
}
