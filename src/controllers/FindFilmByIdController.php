<?php

class FindFilmByIdController extends View
{
    private FindFilmById $service;

    public function __construct(
        FindFilmById $service
    ) {
        $this->service = $service;
    }

    public function execute(string $id)
    {
        $response = $this->service->execute($id);

        $this->render_page($response, 'film');
    }
}
