<?php

class FindFilmByIdService
{
    private HttpClient $httpClient;
    private Logger $logger;
    private Cache $cache;
    private CommentsRepository $comments_repository;

    public function __construct(
        HttpClient $httpClient,
        Logger $logger,
        Cache $cache,
        CommentsRepository $comments_repository
    ) {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
        $this->cache = $cache;
        $this->comments_repository = $comments_repository;
    }

    public function execute(string $id): array
    {
        $this->logger->register('DEBUG', 'API', "Dados do request: \n\n" . json_encode(['id' => $id]));

        $film = [];
        $cache_name = "film_$id";

        $film = $this->cache->get($cache_name);
        $no_cache = count($film) < 1;
        if ($no_cache) {
            $url = "https://swapi.py4e.com/api/films/$id/?format=json";
            $film = $this->httpClient->get($url);

            $this->cache->set($cache_name, $film);
        }

        $date_array = explode('-', $film['release_date']);
        $film_year = intval($date_array[0]);
        $film_month = intval($date_array[1]);
        $film_day = intval($date_array[2]);

        $years = intval(date('Y')) - $film_year;
        $months = ($years * 12) + $film_month;
        $days = ($years * 365) + $film_day;

        $this->logger->register('INFO', 'API', 'Selecionando os dados do filme...');

        $result = [
            'id' => $id,
            'title' => $film['title'],
            'episode' => '' . $film['episode_id'],
            'opening_crawl' => $film['opening_crawl'],
            'director' => $film['director'],
            'producer' => $film['producer'],
            'release_date' => DateTimeImmutable::createFromFormat('Y-m-d', $film['release_date'])->format('d/m/Y'),
            'film_age' => "$years anos, $months meses e $days dias",
        ];

        $this->logger->register('INFO', 'API', 'Buscando os personagens do filme...');

        $characters = $this->get_characters($film['characters']);
        $comments = $this->get_film_comments($id);

        $result['characters'] = $characters;
        $result = array_merge($result, $comments);

        $this->logger->register('INFO', 'API', 'Finalizando requisição...');
        $this->logger->register('DEBUG', 'API', "Dados do response: \n\n" . json_encode($result));

        return $result;
    }

    private function get_characters(array $characters_urls): array
    {
        $get_id_from_url = function (string $url): string {
            $url_array = explode('/', $url);
            array_pop($url_array);
            $id = array_pop($url_array);

            return $id;
        };

        $characters = [];

        foreach ($characters_urls as $index => $url) {
            $id = $get_id_from_url($url);
            $cache_name = "character_$id";

            $character = $this->cache->get($cache_name);
            $no_cache = count($character) < 1;
            if ($no_cache) {
                $character = $this->httpClient->get($url);

                $this->cache->set($cache_name, $character);
            }

            $this->logger->register('INFO', 'API', 'Selecionando os dados do personagem...');

            array_push($characters, [
                'id' => $id,
                'name' => $character['name'],
            ]);
        }

        return $characters;
    }

    private function get_film_comments(int $film_id): array
    {
        $comments = $this->comments_repository->get_comments_by_film_id($film_id);

        if (count($comments) < 1) {
            return [
                'total_comments' => 0,
                'comments' => [],
            ];
        }

        $updated_comments = array_map(function ($comment) {
            $date = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $comment['date'])->format('d/m/Y H:i');
            $comment['date'] = $date;
            return $comment;
        }, $comments);

        return [
            'total_comments' => count($updated_comments),
            'comments' => $updated_comments,
        ];
    }
}
