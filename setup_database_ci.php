<?php

require_once __DIR__."/src/Env.php";

$host = DB_HOST;
$port = DB_PORT;
$user = DB_USER;
$password = DB_PASSWORD;
$charset = "utf8mb4";

$dsn = "mysql:host=$host;port=$port;charset=$charset";
$pdo = new PDO($dsn, $user, $password);

$sql = file_get_contents(__DIR__."/database_test.sql");

$pdo->exec($sql);
