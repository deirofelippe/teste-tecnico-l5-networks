<?php

require_once __DIR__ . '/../../src/utils/RequireAll.php';

use PHPUnit\Framework\TestCase;

final class FindAllFilmsServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        \Mockery::close();
    }

    public function test_deve_buscar_filmes(): void
    {
        $mock_cache = \Mockery::mock(Cache::class);
        $mock_cache->shouldReceive('get')->with('films')->andReturn([]);
        $mock_cache->shouldReceive('set')->andReturn();

        $mock_http_client = \Mockery::mock(HttpClient::class);
        $mock_response = ['results' => [['url' => 'https://teste.com/125/', 'title' => 'titulo teste', 'release_date' => '1977-10-01']]];
        $mock_http_client->shouldReceive('get')->andReturn($mock_response);

        $mock_logger = \Mockery::mock(Logger::class);
        $mock_logger->shouldReceive('register');

        $service = new FindAllFilmsService($mock_http_client, $mock_logger, $mock_cache);

        $films = $service->execute();

        $this->assertSame(1, count($films));

        $this->assertSame('125', $films[0]['id']);
        $this->assertSame('titulo teste', $films[0]['title']);
        $this->assertSame('01/10/1977', $films[0]['release_date']);
    }
}
