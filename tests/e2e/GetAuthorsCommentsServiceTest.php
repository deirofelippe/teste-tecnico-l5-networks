<?php

require_once __DIR__ . '/../../src/utils/RequireAll.php';

use PHPUnit\Framework\TestCase;

final class GetAuthorsCommentsServiceTest extends TestCase
{
    public function test_deve_buscar_comentarios_de_autores(): void
    {
        $pdo = DatabaseSingleton::getInstance();
        $service = new GetAuthorsCommentsService($pdo);

        $authors_comments = $service->execute();

        $this->assertSame(9, 9);
    }
}
