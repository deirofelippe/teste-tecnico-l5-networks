<?php

class CreateCommentService
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function execute(array $data)
    {
        $film_id = $data['film_id'];
        $film_name = $data['film_name'];
        $author = $data['author'];
        $comment = $data['comment'];

        $pdo = $this->pdo;

        $stmt = $pdo->prepare('SELECT id FROM Film WHERE id = :id');
        $stmt->bindParam(':id', $film_id);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if (count($result) < 1) {
            $stmt = $pdo->prepare('INSERT INTO Film (id, name) VALUES (:id, :name)');
            $stmt->bindParam(':id', $film_id);
            $stmt->bindParam(':name', $film_name);
            $stmt->execute();
        }

        $stmt = $this->pdo->prepare('SELECT id FROM Author WHERE name = :name');
        $stmt->bindParam(':name', $author);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $author_id = 0;
        if (count($result) < 1) {
            $author_id = time();

            $stmt = $pdo->prepare('INSERT INTO Author (id, name) VALUES (:id, :name)');
            $stmt->bindParam(':id', $author_id);
            $stmt->bindParam(':name', $author);
            $stmt->execute();
        } else {
            $author_id = $result[0]['id'];
        }

        $created_at = date('Y-m-d H:i:s');

        $stmt = $pdo->prepare('INSERT INTO Comment (film_id, author_id, comment, created_at) VALUES (:film_id, :author_id, :comment, :created_at)');
        $stmt->bindParam(':film_id', $film_id);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->execute();

        return [
            'author' => $author,
            'author_id' => $author_id,
            'comment' => $comment,
            'date' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $created_at)->format('d/m/Y H:i'),
        ];
    }
}
