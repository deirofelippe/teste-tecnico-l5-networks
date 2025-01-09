<?php

declare(strict_types=1);

require_once __DIR__."/../../src/HttpClient.php";
require_once __DIR__."/../../src/Cache.php";
require_once __DIR__."/../../src/FindAllFilms.php";

use PHPUnit\Framework\TestCase;

final class FindAllFilmsTest extends TestCase
{
    public function test_deve_buscar_filmes(): void
    {
        $httpClient = new HttpClient();
        $cache = new Cache();

        $service = new FindAllFilms($httpClient, $cache);

        $films = $service->execute();

        $this->assertSame(7, count($films));
    }
}
