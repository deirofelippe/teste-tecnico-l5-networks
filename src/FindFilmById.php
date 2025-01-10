<?php

class FindFilmById
{
    public function __construct(
        private HttpClient $httpClient,
        private Cache $cache
    ) {
    }

    public function execute(string $id): array
    {
        $film = [];
        $cache_name = "film_$id";

        $film = $this->cache->get($cache_name);
        $no_cache = count($film) < 1;
        if ($no_cache) {
            $url = "https://swapi.py4e.com/api/films/$id/?format=json";
            $film = $this->httpClient->get($url);

            $this->cache->set($cache_name, $film);
        }

        $date_array = explode("-", $film["release_date"]);
        $film_year = intval($date_array[0]);
        $film_month = intval($date_array[1]);
        $film_day = intval($date_array[2]);

        $years = intval(date("Y")) - $film_year;
        $months = ($years * 12) + $film_month;
        $days = ($years * 365) + $film_day;

        $result = [
            "id" => $id,
            "title" => $film["title"],
            "episode" => "".$film["episode_id"],
            "opening_crawl" => $film["opening_crawl"],
            "director" => $film["director"],
            "producer" => $film["producer"],
            "release_date" => DateTimeImmutable::createFromFormat('Y-m-d', $film["release_date"])->format("d/m/Y")
            ,
            "film_age" => "$years anos, $months meses e $days dias",
        ];

        $characters = $this->get_characters($film["characters"]);

        $result["characters"] = $characters;

        return $result;
    }

    private function get_characters(array $characters_urls): array
    {
        $get_id_from_url = function (string $url): string {
            $url_array = explode("/", $url);
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

            array_push($characters, [
                "id" => $id,
                "name" => $character["name"],
            ]);
        }

        return $characters;
    }
}
