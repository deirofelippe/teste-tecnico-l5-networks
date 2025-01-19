<?php

class FindAllFilmsController extends View
{
    private FindAllFilmsService $service;

    public function __construct(
        FindAllFilmsService $service
    ) {
        $this->service = $service;
    }

    public function execute()
    {
        $response = $this->service->execute();

        $this->render_page($response, 'films');
    }
}
