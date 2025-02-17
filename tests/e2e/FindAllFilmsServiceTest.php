<?php

require_once __DIR__ . '/../../src/utils/RequireAll.php';

use PHPUnit\Framework\TestCase;

final class FindAllFilmsServiceTest extends TestCase
{
    public function test_deve_buscar_filmes(): void
    {
        $pdo = DatabaseSingleton::getInstance();
        $logger = new Logger(new LogsRepository($pdo));
        $http_client = new HttpClient($logger);
        $cache = new Cache($logger);

        $service = new FindAllFilmsService($http_client, $logger, $cache);

        $films = $service->execute();

        $this->assertSame(7, count($films));
    }
}
