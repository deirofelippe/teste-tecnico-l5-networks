<?php

declare(strict_types=1);

require_once __DIR__."/../../src/HttpClient.php";
require_once __DIR__."/../../src/Cache.php";
require_once __DIR__."/../../src/FindFilmById.php";

use PHPUnit\Framework\TestCase;

final class FindFilmByIdTest extends TestCase
{
    public function test_deve_buscar_filme_pelo_id(): void
    {
        date_default_timezone_set("America/Sao_Paulo");

        $httpClient = new HttpClient();
        $cache = new Cache();

        $service = new FindFilmById($httpClient, $cache);

        $id = "1";
        $film = $service->execute($id);

        $this->assertSame(9, count($film));
    }
}
