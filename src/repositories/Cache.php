<?php

// @codeCoverageIgnoreStart
class Cache
{
    private Logger $logger;

    public function __construct(
        Logger $logger
    ) {
        $this->logger = $logger;
    }

    public function get(string $name): array
    {
        $execute = function () use ($name): array {
            $file = __DIR__ . "/../../cache/$name.json";
            
            $not_exists = !file_exists($file);
            if ($not_exists) {
                return [];
            }

            $this->logger->register('INFO', 'CACHE', "Busca de dados no cache, cache_name '$name'");
            $data = file_get_contents($file);

            $this->logger->register('DEBUG', 'CACHE', 'Busca feita');
            $this->logger->register('DEBUG', 'CACHE', "Dados: \n\n$data");
            $data = json_decode($data, true);

            return $data;
        };

        try {
            return $execute();
        } catch (\Exception $e) {
            $this->logger->register('ERROR', 'CACHE', 'Erro ao buscar dados no cache');
            $this->logger->register('ERROR', 'CACHE', "Input: \n\nName: $name");
            $this->logger->register('ERROR', 'CACHE', "Message: \n\n" . $e->getMessage());
            $this->logger->register('ERROR', 'CACHE', "Trace: \n\n" . json_encode($e->getTrace()));

            return [];
        }
    }

    public function set(string $name, array $data): void
    {
        $execute = function () use ($name, $data) {
            $this->logger->register('INFO', 'CACHE', "Inserção de dados no cache, cache_name '$name'");

            $data = json_encode($data);
            $this->logger->register('DEBUG', 'CACHE', "Dados: \n\n $data");

            $file = __DIR__ . "/../../cache/$name.json";
            file_put_contents($file, $data);
        };

        try {
            $execute();
        } catch (\Exception $e) {
            $this->logger->register('ERROR', 'CACHE', 'Erro ao adicionar dados no cache');
            $this->logger->register('ERROR', 'CACHE', "Input: \n\nName: $name\nData: \n\n" . json_encode($data));
            $this->logger->register('ERROR', 'CACHE', "Message: \n\n" . $e->getMessage());
            $this->logger->register('ERROR', 'CACHE', "Trace: \n\n" . json_encode($e->getTrace()));
        }
    }
}
// @codeCoverageIgnoreEnd
