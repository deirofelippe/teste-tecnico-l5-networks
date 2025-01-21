<?php

require_once __DIR__ . '/../../src/utils/RequireAll.php';

use PHPUnit\Framework\TestCase;

final class GetAuthorsCommentsServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        \Mockery::close();
    }

    public function test_deve_buscar_comentarios_dos_autores(): void
    {
        $mock_authors_repository = \Mockery::mock(AuthorsRepository::class);

        $mock_response_1 = [
            [

                'author_id' => 111,
                'author_name' => 'Autor teste 1',
                'film_id' => 1,
                'film_name' => 'Nome do filme teste 2',
                'comment' => 'Comentários teste',
                'date' => '2025-01-21 18:48:30',
            ],
            [

                'author_id' => 222,
                'author_name' => 'Autor teste 2',
                'film_id' => 1,
                'film_name' => 'Nome do filme teste 2',
                'comment' => 'Comentários teste',
                'date' => '2025-01-21 18:48:30',
            ],
            [

                'author_id' => 222,
                'author_name' => 'Autor teste 2',
                'film_id' => 1,
                'film_name' => 'Nome do filme teste 2',
                'comment' => 'Comentários teste',
                'date' => '2025-01-21 18:48:30',
            ],
        ];
        $mock_authors_repository->shouldReceive('get_details_of_authors_comments')->andReturn($mock_response_1);

        $mock_response_2 = [
            [

                'author_name' => 'Autor teste 1',
                'author_id' => 111,
                'total_comments' => 1,
            ],
            [

                'author_name' => 'Autor teste 2',
                'author_id' => 222,
                'total_comments' => 2,
            ],
        ];
        $mock_authors_repository->shouldReceive('get_authors_and_total_comments')->andReturn($mock_response_2);

        $mock_logger = \Mockery::mock(Logger::class);
        $mock_logger->shouldReceive('register')->andReturn();

        $service = new GetAuthorsCommentsService($mock_authors_repository, $mock_logger);

        $authors_comments = $service->execute();

        $this->assertSame(2, count($authors_comments));

        $this->assertSame(1, count($authors_comments[0]['comments']));
        $this->assertSame(111, $authors_comments[0]['author_id']);
        $this->assertSame(2, count($authors_comments[1]['comments']));
        $this->assertSame(222, $authors_comments[1]['author_id']);
    }
}
