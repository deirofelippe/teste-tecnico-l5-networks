<?php

class Cache
{
    public function get(string $name): array
    {
        $file = __DIR__."/../cache/$name.json";

        $not_exists = !file_exists($file);
        if ($not_exists) {
            return [];
        }

        $data = file_get_contents($file);
        $data = json_decode($data, true);

        return $data;
    }

    public function set(string $name, array $data): void
    {
        $data = json_encode($data);
        $file = __DIR__."/../cache/$name.json";
        file_put_contents($file, $data);
    }
}
