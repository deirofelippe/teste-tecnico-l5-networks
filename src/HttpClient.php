<?php

class HttpClient
{
    public function get(string $url): array
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        $output_json = json_decode($output, true);
        return $output_json;
    }

    public function post()
    {
    }
}
