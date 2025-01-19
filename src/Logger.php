<?php

class Logger
{
    private LogsRepository $logs_repository;

    public function __construct(LogsRepository $logs_repository)
    {
        $this->logs_repository = $logs_repository;
    }

    public function register(string $level, string $context, string $description): void
    {
        try {
            $log = new Log($level, $context, $description);

            $this->logs_repository->create_log($log);
        } catch (\Exception $e) {
        }
    }
}
