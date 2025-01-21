<?php

class View
{
    protected function render_page(array $data, string $page_name)
    {
        $backend_url = BACKEND_URL;

        require_once __DIR__ . '/../views/index.php';
    }

    protected function finish_request(int $status_code, array $response_data)
    {
        http_response_code($status_code);

        if (count($response_data) < 1) {
            exit(0);
        }

        header('Content-Type: application/json');
        echo json_encode($response_data);

        exit(0);
    }
}
