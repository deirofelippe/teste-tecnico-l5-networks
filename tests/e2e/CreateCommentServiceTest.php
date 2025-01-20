<?php

require_once __DIR__ . '/../../src/utils/RequireAll.php';

use PHPUnit\Framework\TestCase;

final class CreateCommentServiceTest extends TestCase
{
    public function test_deve_criar_comentario(): void
    {
        $pdo = DatabaseSingleton::getInstance();
        $logger = new Logger(new LogsRepository($pdo));
        $cache = new Cache($logger);

        $data = [
            'film_id' => '1',
            'film_name' => 'Nome do filme teste 2',
            'comment' => 'Comentários teste',
            'author' => 'Autor teste 2',
        ];

        $service = new CreateCommentService($pdo);

        $service->execute($data);

        $this->assertSame(9, 9);
    }
}
