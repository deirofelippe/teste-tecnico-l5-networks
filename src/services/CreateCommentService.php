<?php

class CreateCommentService
{
    private CommentsRepository $comments_repository;
    private FilmsRepository $films_repository;
    private AuthorsRepository $authors_repository;
    private Logger $logger;

    public function __construct(
        CommentsRepository $comments_repository,
        FilmsRepository $films_repository,
        AuthorsRepository $authors_repository,
        Logger $logger
    ) {
        $this->comments_repository = $comments_repository;
        $this->films_repository = $films_repository;
        $this->authors_repository = $authors_repository;
        $this->logger = $logger;
    }

    public function execute(array $data)
    {
        $this->logger->register('INFO', 'API', 'Executando CreateCommentService POST /comments');
        $this->logger->register('DEBUG', 'API', "Dados do request: \n\n" . json_encode($data));

        $film_id = $data['film_id'];
        $film_name = $data['film_name'];
        $author_name = $data['author'];
        $comment = $data['comment'];

        $film_found = $this->films_repository->find_film_by_id($film_id);

        if (count($film_found) < 1) {
            $new_film = [
                'id' => $film_id,
                'name' => $film_name,
            ];

            $this->films_repository->create_film($new_film);
        }

        $author_found = $this->authors_repository->find_author_by_name($author_name);

        $author_id = 0;
        if (count($author_found) < 1) {
            $author_id = time();

            $new_author = [
                'id' => $author_id,
                'name' => $author_name,
            ];
            $this->authors_repository->create_author($new_author);
        } else {
            $author_id = $author_found[0]['id'];
        }

        $new_comment = [
            'film_id' => $film_id,
            'author_id' => $author_id,
            'comment' => $comment,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->comments_repository->create_comment($new_comment);

        $created_comment = [
            'author' => $author_name,
            'author_id' => $author_id,
            'comment' => $comment,
            'date' => DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $new_comment['created_at'])->format('d/m/Y H:i'),
        ];

        $this->logger->register('INFO', 'API', 'Finalizando CreateCommentService...');
        $this->logger->register('DEBUG', 'API', "Dados do response: \n\n" . json_encode($created_comment));

        return $created_comment;
    }
}
