<?php

class GetAuthorsCommentsService
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function execute(): array
    {
        $pdo = $this->pdo;

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

        $authors_with_comments = array_map(function ($author) use ($comments_details) {
            $comments = [];

            foreach ($comments_details as $index => $comment) {
                if ($comment['author_id'] != $author['author_id']) {
                    continue;
                }

                $date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $comment['date'])->format('d/m/Y H:i');

                $comment_text = $comment['comment'];
                $comment_preview_limit = 50;
                if (strlen($comment_text) > $comment_preview_limit) {
                    $comment_text = substr($comment_text, 0, $comment_preview_limit) . '...';
                }

                array_push($comments, [
                    'film_id' => $comment['film_id'],
                    'film_name' => $comment['film_name'],
                    'date' => $date,
                    'comment' => $comment_text,
                ]);
            }

            $updated_author = array_merge($author, ['comments' => $comments]);

            return $updated_author;
        }, $authors);

        return $authors_with_comments;
    }
}
