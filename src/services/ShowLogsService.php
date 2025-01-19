<?php

class ShowLogsService
{
    private LogsRepository $logs_repository;
    private Logger $logger;

    public function __construct(
        LogsRepository $logs_repository,
        Logger $logger
    ) {
        $this->logs_repository = $logs_repository;
        $this->logger = $logger;
    }

    public function execute(int $limit, int $offset): array
    {
        $logs_repository = $this->logs_repository;

        $logs = $logs_repository->get_logs($limit, $offset);

        $total_logs = $logs_repository->get_total_logs();

        $format_logs_datetime = function (array $log) {
            $datetime = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $log['datetime'])->format('d/m/Y H:i:s');

            return [
                'datetime' => $datetime,
                'level' => $log['level'],
                'context' => $log['context'],
                'description' => $log['description'],
            ];
        };

        $logs = array_map($format_logs_datetime, $logs);

        $next = $offset + $limit;
        if ($next < 0) {
            $next = 0;
        }

        $previous = $offset - $limit;
        if ($previous < 0) {
            $previous = 0;
        }

        $response = [
            'logs' => $logs,
            'total_logs' => $total_logs,
            'limit' => $limit,
            'offset' => $offset,
            'next' => $next,
            'previous' => $previous,
        ];

        return $response;
    }
}
