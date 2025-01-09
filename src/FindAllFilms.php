<?php

class FindAllFilms
{
    public function __construct(
        private HttpClient $httpClient,
        private Cache $cache
    ) {
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
                "release_date" => $film["release_date"],
            ];
        };

        $films = array_map($get_films_data, $films);

        return $films;
    }
}
