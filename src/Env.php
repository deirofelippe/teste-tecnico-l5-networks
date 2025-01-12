<?php

$filename = __DIR__."/../env.json";

$env_vars = file_get_contents($filename);
$env_vars = json_decode($env_vars, true);

$env = getenv('ENV') ?? $env_vars["ENV"];

define('ENV', $env);

if ($env === "test") {
    define('DB_HOST', $env_vars["DB_HOST_TEST"]);
    define('DB_DATABASE', $env_vars["DB_DATABASE_TEST"]);
    define('DB_USER', $env_vars["DB_USER_TEST"]);
    define('DB_PASSWORD', $env_vars["DB_PASSWORD_TEST"]);
} else {
    define('DB_HOST', $env_vars["DB_HOST"]);
    define('DB_DATABASE', $env_vars["DB_DATABASE"]);
    define('DB_USER', $env_vars["DB_USER"]);
    define('DB_PASSWORD', $env_vars["DB_PASSWORD"]);
}
