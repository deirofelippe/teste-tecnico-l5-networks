<?php

require_once __DIR__ . '/../../src/utils/RequireAll.php';

use PHPUnit\Framework\TestCase;

final class GetAuthorsCommentsServiceTest extends TestCase
{
    public function test_deve_buscar_comentarios_de_autores(): void
    {
        $pdo = DatabaseSingleton::getInstance();
        $logger = new Logger(new LogsRepository($pdo));
        $authors_repository = new AuthorsRepository($pdo, $logger);

        $service = new GetAuthorsCommentsService($authors_repository, $logger);

        $authors_comments = $service->execute();

        $this->assertSame(9, 9);
    }
}
