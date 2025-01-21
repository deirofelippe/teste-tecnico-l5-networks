<?php

class LogsRepository
{
    private PDO $pdo;

    public function __construct(
        PDO $pdo
    ) {
        $this->pdo = $pdo;
    }

    public function create_log(Log $log)
    {
        $pdo = $this->pdo;

        $attributes = $log->get_attributes();

        $execute = function () use ($pdo, $attributes) {
            $stmt = $pdo->prepare('INSERT INTO Log (datetime, level, context, description) VALUES (:datetime, :level, :context, :description)');

            $stmt->bindParam(':datetime', $attributes['datetime']);
            $stmt->bindParam(':level', $attributes['level']);
            $stmt->bindParam(':context', $attributes['context']);
            $stmt->bindParam(':description', $attributes['description']);

            $stmt->execute();
        };

        try {
            $execute();
        } catch (\Exception $e) {
            var_dump($e->getTrace());
            var_dump($e->getMessage());
        }
    }

    public function get_total_logs()
    {
        $pdo = $this->pdo;

        $execute = function () use ($pdo): int {
            $stmt = $pdo->prepare('SELECT count(id) as total_logs FROM Log');
            $stmt->execute();
            $result = $stmt->fetchAll();

            $total_logs = $result[0]['total_logs'];

            return $total_logs;
        };

        try {
            return $execute();
        } catch (\Exception $e) {
            $this->create_log(new Log('ERROR', 'DB', 'Erro no banco de dados'));
            $this->create_log(new Log('ERROR', 'DB', "Input: \n\nName: $name"));
            $this->create_log(new Log('ERROR', 'DB', "Message: \n\n" . $e->getMessage()));
            $this->create_log(new Log('ERROR', 'DB', "Trace: \n\n" . json_encode($e->getTrace())));

            throw $e;
        }
    }

    public function get_logs(int $limit, int $offset)
    {
        $pdo = $this->pdo;

        $execute = function () use ($limit, $offset, $pdo): array {
            $stmt = $pdo->prepare('SELECT datetime, level, context, description FROM Log ORDER BY id DESC LIMIT :limit OFFSET :offset');

            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

            $stmt->execute();
            $logs = $stmt->fetchAll();

            return $logs;
        };

        try {
            return $execute();
        } catch (\Exception $e) {
            $this->create_log(new Log('ERROR', 'DB', 'Erro no banco de dados'));
            $this->create_log(new Log('ERROR', 'DB', "Input: \n\nLimit: $name\nOffset: $offset"));
            $this->create_log(new Log('ERROR', 'DB', "Message: \n\n" . $e->getMessage()));
            $this->create_log(new Log('ERROR', 'DB', "Trace: \n\n" . json_encode($e->getTrace())));

            throw $e;
        }
    }
}
