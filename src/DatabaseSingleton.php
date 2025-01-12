<?php

require_once __DIR__."/Env.php";

class DatabaseSingleton
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): PDO
    {
        $instance = self::$instance;
        if (self::$instance === null) {
            $host = DB_HOST;
            $database = DB_DATABASE;
            $user = DB_USER;
            $password = DB_PASSWORD;

            $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password, [
                PDO::ATTR_PERSISTENT => true
            ]);

            self::$instance = $pdo;
        }

        return self::$instance ;
    }
}
