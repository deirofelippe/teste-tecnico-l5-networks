<?php

require_once __DIR__."/../../src/utils/RequireAll.php";

use PHPUnit\Framework\TestCase;

final class FindFilmByIdTest extends TestCase
{
    protected function tearDown(): void
    {
        \Mockery::close();
    }

    public function test_deve_buscar_filme(): void
    {
        $mock_cache = \Mockery::mock(Cache::class);
        $mock_cache->shouldReceive('get')->once()->with("film_1")->andReturn([]);
        $mock_cache->shouldReceive('set')->once()->andReturn();

        $mock_cache->shouldReceive('get')->once()->with("character_1")->andReturn([]);
        $mock_cache->shouldReceive('set')->once()->andReturn();

        $mock_cache->shouldReceive('get')->once()->with("character_2")->andReturn([]);
        $mock_cache->shouldReceive('set')->once()->andReturn();

        $mock_http_client = \Mockery::mock(HttpClient::class);
        $mock_response_film = [
            "url" => "https://teste.com/125/",
            "title" => "titulo teste",
            "release_date" => "1998-07-10",
            "episode_id" => 1,
            "opening_crawl" => "descricao do filme",
            "director" => "Teste",
            "producer" => "Teste 1, Teste 2",
            "characters" => [
                "https://teste.com/1/",
                "https://teste.com/2/",
            ],
        ];

        $mock_response_character1 = [
            "name" => "Teste char 1",
        ];

        $mock_response_character2 = [
            "name" => "Teste char 2",
        ];

        $mock_http_client->shouldReceive('get')->once()->andReturn($mock_response_film);
        $mock_http_client->shouldReceive('get')->once()->andReturn($mock_response_character1);
        $mock_http_client->shouldReceive('get')->once()->andReturn($mock_response_character2);

        $mock_logger = \Mockery::mock(Logger::class);
        $mock_logger->shouldReceive('register');

        $service = new FindFilmById($mock_http_client, $mock_logger, $mock_cache);

        $film_id = "1";
        $film = $service->execute($film_id);

        $this->assertSame(9, count($film));

        $this->assertSame(2, count($film["characters"]));
        $this->assertSame(2, count($film["characters"][0]));
        $this->assertSame("Teste char 1", $film["characters"][0]["name"]);
        $this->assertSame(2, count($film["characters"][1]));
        $this->assertSame("Teste char 2", $film["characters"][1]["name"]);

        $this->assertSame("10/07/1998", $film["release_date"]);
        $this->assertSame("27 anos, 331 meses e 9865 dias", $film["film_age"]);
    }
}
