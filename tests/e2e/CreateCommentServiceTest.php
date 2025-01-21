<?php

require_once __DIR__ . '/../../src/utils/RequireAll.php';

use PHPUnit\Framework\TestCase;

final class CreateCommentServiceTest extends TestCase
{
    public function test_deve_criar_comentario(): void
    {
        $pdo = DatabaseSingleton::getInstance();
        $logger = new Logger(new LogsRepository($pdo));
        $comments_repository = new CommentsRepository($pdo, $logger);
        $films_repository = new FilmsRepository($pdo, $logger);
        $authors_repository = new AuthorsRepository($pdo, $logger);

        $data = [
            'film_id' => '1',
            'film_name' => 'Nome do filme teste 2',
            'comment' => 'Comentários teste',
            'author' => 'Autor teste 2',
        ];

        $service = new CreateCommentService(
            $comments_repository,
            $films_repository,
            $authors_repository,
            $logger
        );

        $result = $service->execute($data);

        $this->assertSame(4, count($result));
    }
}
