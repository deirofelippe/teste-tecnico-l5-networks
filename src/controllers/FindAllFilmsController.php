<?php

class FindAllFilmsController extends View
{
    private FindAllFilms $service;

    public function __construct(
        FindAllFilms $service,
    ) {
        $this->service = $service;
    }

    public function execute()
    {
        $response = $this->service->execute();

        $this->render_page($response, "films");
    }
}
