<?php

class FindFilmByIdController extends View
{
    private FindFilmByIdService $service;

    public function __construct(
        FindFilmByIdService $service
    ) {
        $this->service = $service;
    }

    public function execute(string $id)
    {
        $response = $this->service->execute($id);

        $this->render_page($response, 'film');
    }
}
