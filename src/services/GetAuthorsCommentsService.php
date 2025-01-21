<?php

class GetAuthorsCommentsService
{
    private AuthorsRepository $authors_repository;
    private Logger $logger;

    public function __construct(
        AuthorsRepository $authors_repository,
        Logger $logger
    ) {
        $this->authors_repository = $authors_repository;
        $this->logger = $logger;
    }

    public function execute(): array
    {
        $this->logger->register('INFO', 'API', 'Executando GetAuthorsCommentsService GET /authors/comments');
        $this->logger->register('DEBUG', 'API', "Dados do request: \n\n" . json_encode([]));

        $comments_details = $this->authors_repository->get_details_of_authors_comments();

        $authors = $this->authors_repository->get_authors_and_total_comments();

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

        $this->logger->register('INFO', 'API', 'Finalizando GetAuthorsCommentsService...');
        $this->logger->register('DEBUG', 'API', "Dados do response: \n\n" . json_encode($authors_with_comments));

        return $authors_with_comments;
    }
}
