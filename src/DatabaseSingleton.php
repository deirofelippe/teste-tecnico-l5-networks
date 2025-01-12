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
            $port = DB_PORT;
            $database = DB_DATABASE;
            $user = DB_USER;
            $password = DB_PASSWORD;
            $charset = "utf8mb4";

            $options = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];

            $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=$charset";
            $pdo = new PDO($dsn, $user, $password, $options);

            self::$instance = $pdo;
        }

        return self::$instance ;
    }
}
