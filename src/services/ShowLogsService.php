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

        $total_logs = $logs_repository->get_total_logs();

        if ($offset >= $total_logs) {
            $offset = $total_logs - 1;
        }

        $logs = $logs_repository->get_logs($limit, $offset);

        $format_logs_datetime = function (array $log) {
            $datetime = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $log['datetime'])->format('d/m/Y H:i:s');

            $description = $log['description'];
            if (strlen($description) > 186) {
                $description = "<textarea class='w-100'>$description</textarea>";
            }

            return [
                'datetime' => $datetime,
                'level' => $log['level'],
                'context' => $log['context'],
                'description' => $description,
            ];
        };

        $logs = array_map($format_logs_datetime, $logs);

        $pagination_info = $this->calculate_pagination_info($limit, $offset, $total_logs);

        $response = [
            'logs' => $logs,
            'total_logs' => $total_logs,
            'limit' => $limit,
            'offset' => $pagination_info['offset'],
            'next' => $pagination_info['next'],
            'previous' => $pagination_info['previous'],
        ];

        return $response;
    }

    private function calculate_pagination_info(int $limit, int $offset, int $total_logs): array
    {
        $next = $offset + $limit;
        if ($next > $total_logs) {
            $next = $total_logs - 1;
            $offset = $total_logs;
        }

        if ($next < 0) {
            $next = 0;
        }

        $previous = $offset - $limit;
        if ($previous < 0) {
            $previous = 0;
        }

        return [
            'offset' => $offset,
            'next' => $next,
            'previous' => $previous,
        ];
    }
}
