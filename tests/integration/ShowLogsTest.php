<?php

require_once __DIR__ . '/../../src/utils/RequireAll.php';

use PHPUnit\Framework\TestCase;

final class ShowLogsTestTest extends TestCase
{
    protected function tearDown(): void
    {
        \Mockery::close();
    }

    public function test_deve_buscar_filme(): void
    {
        $mock_logger = \Mockery::mock(Logger::class);
        $mock_logger->shouldReceive('register');

        $mock_logs = [
            [
                'datetime' => '2025-01-18 14:15:20',
                'level' => 'INFO',
                'context' => 'Contexto 1',
                'description' => 'Descrição 1',
            ],
            [
                'datetime' => '2023-01-18 18:18:28',
                'level' => 'INFO',
                'context' => 'Contexto 2',
                'description' => 'Descrição 2',
            ],
        ];
        $limit = 2;
        $offset = 0;
        $mock_total_logs = 10;
        $mock_next = $offset + $limit;
        $mock_previous = 0;

        $mock_logs_repository = \Mockery::mock(LogsRepository::class);
        $mock_logs_repository->shouldReceive('get_logs')->once()->andReturn($mock_logs);
        $mock_logs_repository->shouldReceive('get_total_logs')->once()->andReturn($mock_total_logs);

        $service = new ShowLogsService($mock_logs_repository, $mock_logger);

        $response = $service->execute($limit, $offset);

        $this->assertSame(6, count($response));

        $this->assertSame('18/01/2025 14:15:20', $response['logs'][0]['datetime']);
        $this->assertSame('INFO', $response['logs'][0]['level']);
        $this->assertSame('Contexto 1', $response['logs'][0]['context']);
        $this->assertSame('Descrição 1', $response['logs'][0]['description']);

        $this->assertSame($mock_total_logs, $response['total_logs']);
        $this->assertSame($limit, $response['limit']);
        $this->assertSame($offset, $response['offset']);
        $this->assertSame($mock_next, $response['next']);
        $this->assertSame($mock_previous, $response['previous']);
    }
}
