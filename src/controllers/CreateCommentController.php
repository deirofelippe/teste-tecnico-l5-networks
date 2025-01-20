<?php

class CreateCommentController extends View
{
    private CreateCommentService $service;

    public function __construct(
        CreateCommentService $service
    ) {
        $this->service = $service;
    }

    public function execute(array $comment)
    {
        $response = $this->service->execute($comment);

        $this->finish_request(201, $response);
    }
}
