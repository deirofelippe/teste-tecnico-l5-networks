<?php

class CommentsRepository
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

    public function get_comments_by_film_id($film_id): array
    {
        $pdo = $this->pdo;

        $execute = function () use ($pdo, $film_id): array {
            $query = <<<EOL
                SELECT c.id AS comment_id, c.comment AS comment, c.created_at AS date, a.name AS author
                FROM Comment AS c
                JOIN Author AS a ON c.author_id = a.id
                JOIN Film AS f ON c.film_id = f.id
                WHERE f.id = :film_id
                ORDER BY date DESC;
            EOL;

            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':film_id', $film_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll();

            return $result;
        };

        try {
            $this->logger->register('INFO', 'DB', 'Buscando comentarios do filme...');
            $this->logger->register('DEBUG', 'DB', 'Input: \n\n' . json_encode(['film_id' => $film_id]));

            return $execute();
        } catch (\Exception $e) {
            $this->logger->register('ERROR', 'DB', 'Erro no banco de dados');
            $this->logger->register('ERROR', 'DB', "Input: \n\nFilm_id: $film_id");
            $this->logger->register('ERROR', 'DB', "Message: \n\n" . $e->getMessage());
            $this->logger->register('ERROR', 'DB', "Trace: \n\n" . json_encode($e->getTrace()));

            throw $e;
        }
    }
}
