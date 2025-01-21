<?php

require_once __DIR__ . '/../../src/utils/RequireAll.php';

use PHPUnit\Framework\TestCase;

final class FindFilmByIdServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        \Mockery::close();
    }

    public function test_deve_buscar_filme(): void
    {
        $mock_cache = \Mockery::mock(Cache::class);
        $mock_cache->shouldReceive('get')->once()->with('film_1')->andReturn([]);
        $mock_cache->shouldReceive('set')->once()->andReturn();

        $mock_cache->shouldReceive('get')->once()->with('character_1')->andReturn([]);
        $mock_cache->shouldReceive('set')->once()->andReturn();

        $mock_cache->shouldReceive('get')->once()->with('character_2')->andReturn([]);
        $mock_cache->shouldReceive('set')->once()->andReturn();

        $mock_http_client = \Mockery::mock(HttpClient::class);
        $mock_response_film = [
            'url' => 'https://teste.com/125/',
            'title' => 'titulo teste',
            'release_date' => '1998-07-10',
            'episode_id' => 1,
            'opening_crawl' => 'descricao do filme',
            'director' => 'Teste',
            'producer' => 'Teste 1, Teste 2',
            'characters' => [
                'https://teste.com/1/',
                'https://teste.com/2/',
            ],
        ];

        $mock_response_character1 = [
            'name' => 'Teste char 1',
        ];

        $mock_response_character2 = [
            'name' => 'Teste char 2',
        ];

        $mock_http_client->shouldReceive('get')->once()->andReturn($mock_response_film);
        $mock_http_client->shouldReceive('get')->once()->andReturn($mock_response_character1);
        $mock_http_client->shouldReceive('get')->once()->andReturn($mock_response_character2);

        $mock_comments_repository = \Mockery::mock(CommentsRepository::class);
        $mock_film_comments = [
            [
                'comment_id' => 3,
                'comment' => 'Comentários teste',
                'date' => '2025-01-19 21:44:10',
                'author' => 'Autor teste',
            ], [
                'comment_id' => 2,
                'comment' => 'Comentários teste',
                'date' => '2025-01-19 21:44:09',
                'author' => 'Autor teste',
            ],
        ];

        $mock_comments_repository->shouldReceive('get_comments_by_film_id')->once()->andReturn($mock_film_comments);

        $mock_logger = \Mockery::mock(Logger::class);
        $mock_logger->shouldReceive('register');

        $service = new FindFilmByIdService($mock_http_client, $mock_logger, $mock_cache, $mock_comments_repository);

        $film_id = '1';
        $film = $service->execute($film_id);

        $this->assertSame(11, count($film));

        $this->assertSame(2, count($film['characters']));
        $this->assertSame(2, count($film['characters'][0]));
        $this->assertSame('Teste char 1', $film['characters'][0]['name']);
        $this->assertSame(2, count($film['characters'][1]));
        $this->assertSame('Teste char 2', $film['characters'][1]['name']);

        $this->assertSame('10/07/1998', $film['release_date']);
        $this->assertSame('27 anos, 331 meses e 9865 dias', $film['film_age']);

        $this->assertSame(2, $film['total_comments']);
        $this->assertSame('19/01/2025 21:44', $film['comments'][0]['date']);
        $this->assertSame('19/01/2025 21:44', $film['comments'][1]['date']);
    }
}
