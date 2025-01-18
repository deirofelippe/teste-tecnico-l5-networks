<?php

require_once __DIR__."/../../src/utils/RequireAll.php";

use PHPUnit\Framework\TestCase;

final class FindFilmByIdTest extends TestCase
{
    public function test_deve_buscar_filme_pelo_id(): void
    {
        $pdo = DatabaseSingleton::getInstance();
        $logger = new Logger(new LogsRepository($pdo));
        $httpClient = new HttpClient($logger);
        $cache = new Cache($logger);


        $service = new FindFilmById($httpClient, $logger, $cache);

        $id = "1";
        $film = $service->execute($id);

        $this->assertSame(9, count($film));
    }
}
