<?php

class GetAuthorsCommentsController extends View
{
    private GetAuthorsCommentsService $service;

    public function __construct(
        GetAuthorsCommentsService $service
    ) {
        $this->service = $service;
    }

    public function execute()
    {
        $response = $this->service->execute();

        //dd($response[0]);

        $this->render_page($response, 'authors_comments');
    }
}
