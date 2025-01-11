<?php

class FindAllFilms
{
    private HttpClient $httpClient;
    private Cache $cache;

    public function __construct(
        HttpClient $httpClient,
        Cache $cache
    ) {
        $this->httpClient = $httpClient;
        $this->cache = $cache;
    }

    public function execute(): array
    {
        $films = [];
        $cache_name = "films";

        $films = $this->cache->get($cache_name);
        $no_cache = count($films) < 1;
        if ($no_cache) {
            $url = "https://swapi.py4e.com/api/films/?format=json";
            $films = $this->httpClient->get($url);

            $this->cache->set($cache_name, $films);
        }

        $films = $films["results"];

        $get_films_data = function ($film): array {
            $url_array = explode("/", $film["url"]);
            array_pop($url_array);
            $id = array_pop($url_array);

            return [
                "id" => $id,
                "title" => $film["title"],
                "release_date" => DateTimeImmutable::createFromFormat("Y-m-d", $film["release_date"])->format("d/m/Y"),
            ];
        };

        $films = array_map($get_films_data, $films);

        $sort = function ($film1, $film2) {
            $film1_timestamp = DateTimeImmutable::createFromFormat("d/m/Y", $film1["release_date"])->getTimestamp();
            $film2_timestamp = DateTimeImmutable::createFromFormat("d/m/Y", $film2["release_date"])->getTimestamp();

            if ($film1 == $film2) {
                return 0;
            }
            return ($film1_timestamp < $film2_timestamp) ? -1 : 1;
        };

        uasort($films, $sort);

        return $films;
    }
}
