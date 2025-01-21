<?php

require_once __DIR__ . '/../../src/utils/RequireAll.php';

use PHPUnit\Framework\TestCase;

final class CreateCommentServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        \Mockery::close();
    }

    public function test_deve_criar_comentario_filme_e_autor(): void
    {
        $mock_comments_repository = \Mockery::mock(CommentsRepository::class);
        $mock_comments_repository->shouldReceive('create_comment')->once()->andReturn();

        $mock_films_repository = \Mockery::mock(FilmsRepository::class);
        $mock_films_repository->shouldReceive('find_film_by_id')->once()->andReturn([]);
        $mock_films_repository->shouldReceive('create_film')->once()->andReturn();

        $mock_authors_repository = \Mockery::mock(AuthorsRepository::class);
        $mock_authors_repository->shouldReceive('find_author_by_name')->once()->andReturn([]);
        $mock_authors_repository->shouldReceive('create_author')->once()->andReturn();

        $mock_logger = \Mockery::mock(Logger::class);
        $mock_logger->shouldReceive('register')->andReturn();

        $service = new CreateCommentService($mock_comments_repository, $mock_films_repository, $mock_authors_repository, $mock_logger);

        $comment = [
            'film_id' => '1',
            'film_name' => 'Filme teste',
            'author' => 'Author teste',
            'comment' => 'Comentário teste',
        ];

        $created_comment = $service->execute($comment);

        $this->assertSame(4, count($created_comment));
        $this->assertIsInt(1, $created_comment['author_id']);
        $this->assertStringMatchesFormat('%d%d/%d%d/%d%d%d%d %d%d:%d%d', $created_comment['date']);
    }

    public function test_deve_criar_comentario_e_filme(): void
    {
        $mock_comments_repository = \Mockery::mock(CommentsRepository::class);
        $mock_comments_repository->shouldReceive('create_comment')->once()->andReturn();

        $mock_films_repository = \Mockery::mock(FilmsRepository::class);
        $mock_films_repository->shouldReceive('find_film_by_id')->once()->andReturn([]);
        $mock_films_repository->shouldReceive('create_film')->once()->andReturn();

        $mock_authors_repository = \Mockery::mock(AuthorsRepository::class);
        $mock_authors_repository->shouldReceive('find_author_by_name')->once()->andReturn([['id' => 1]]);
        $mock_authors_repository->shouldReceive('create_author')->times(0);

        $mock_logger = \Mockery::mock(Logger::class);
        $mock_logger->shouldReceive('register')->andReturn();

        $service = new CreateCommentService($mock_comments_repository, $mock_films_repository, $mock_authors_repository, $mock_logger);

        $comment = [
            'film_id' => '1',
            'film_name' => 'Filme teste',
            'author' => 'Author teste',
            'comment' => 'Comentário teste',
        ];

        $created_comment = $service->execute($comment);

        $this->assertSame(4, count($created_comment));
        $this->assertIsInt(1, $created_comment['author_id']);
        $this->assertStringMatchesFormat('%d%d/%d%d/%d%d%d%d %d%d:%d%d', $created_comment['date']);
    }

    public function test_deve_criar_comentario(): void
    {
        $mock_comments_repository = \Mockery::mock(CommentsRepository::class);
        $mock_comments_repository->shouldReceive('create_comment')->once()->andReturn();

        $mock_films_repository = \Mockery::mock(FilmsRepository::class);
        $mock_films_repository->shouldReceive('find_film_by_id')->once()->andReturn([['id' => 1]]);
        $mock_films_repository->shouldReceive('create_film')->times(0);

        $mock_authors_repository = \Mockery::mock(AuthorsRepository::class);
        $mock_authors_repository->shouldReceive('find_author_by_name')->once()->andReturn([['id' => 1]]);
        $mock_authors_repository->shouldReceive('create_author')->times(0);

        $mock_logger = \Mockery::mock(Logger::class);
        $mock_logger->shouldReceive('register')->andReturn();

        $service = new CreateCommentService($mock_comments_repository, $mock_films_repository, $mock_authors_repository, $mock_logger);

        $comment = [
            'film_id' => '1',
            'film_name' => 'Filme teste',
            'author' => 'Author teste',
            'comment' => 'Comentário teste',
        ];

        $created_comment = $service->execute($comment);

        $this->assertSame(4, count($created_comment));
        $this->assertIsInt(1, $created_comment['author_id']);
        $this->assertStringMatchesFormat('%d%d/%d%d/%d%d%d%d %d%d:%d%d', $created_comment['date']);
    }
}
