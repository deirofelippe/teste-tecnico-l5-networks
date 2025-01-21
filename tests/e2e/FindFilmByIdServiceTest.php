<?php

require_once __DIR__ . '/../../src/utils/RequireAll.php';

use PHPUnit\Framework\TestCase;

final class FindFilmByIdServiceTest extends TestCase
{
    public function test_deve_buscar_filme_pelo_id(): void
    {
        $pdo = DatabaseSingleton::getInstance();
        $logger = new Logger(new LogsRepository($pdo));
        $http_client = new HttpClient($logger);
        $cache = new Cache($logger);
        $comments_repository = new CommentsRepository($pdo, $logger);

        $service = new FindFilmByIdService($http_client, $logger, $cache, $comments_repository);

        $id = '1';
        $film = $service->execute($id);

        $this->assertSame(11, count($film));
    }
}
