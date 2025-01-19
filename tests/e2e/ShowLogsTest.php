<?php

require_once __DIR__ . '/../../src/utils/RequireAll.php';

use PHPUnit\Framework\TestCase;

final class ShowLogsTest extends TestCase
{
    public function test_deve_buscar_logs(): void
    {
        $pdo = DatabaseSingleton::getInstance();
        $logger = new Logger(new LogsRepository($pdo));
        $logsRepository = new LogsRepository($pdo, $logger);

        $service = new ShowLogsService($logsRepository, $logger);

        $limit = 3;
        $offset = 0;

        $response = $service->execute($limit, $offset);

        $this->assertSame(6, count($response));
        $this->assertSame(3, count($response['logs']));
        $this->assertSame(3, $response['next']);
        $this->assertSame(0, $response['previous']);
    }
}

// testar se data está no padrão certo, se está ordenado, quantidade next previous e outros, limpar os registros das tabelas
