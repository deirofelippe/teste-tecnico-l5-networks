<?php

class ShowLogsController extends View
{
    private ShowLogsService $service;

    public function __construct(
        ShowLogsService $service
    ) {
        $this->service = $service;
    }

    public function execute(string $limit, string $offset)
    {
        $limit = intval($limit);
        $offset = intval($offset);

        $response = $this->service->execute($limit, $offset);

        $this->render_page($response, 'logs');
    }
}
