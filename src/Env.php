<?php

// @codeCoverageIgnoreStart
$filename = __DIR__ . '/../env.json';

$env_vars = file_get_contents($filename);
$env_vars = json_decode($env_vars, true);

$env = getenv('ENV') ?? $env_vars['ENV'];

define('ENV', $env);

if ($env === 'test') {
    define('DB_HOST', $env_vars['DB_HOST_TEST']);
    define('DB_PORT', $env_vars['DB_PORT_TEST']);
    define('DB_DATABASE', $env_vars['DB_DATABASE_TEST']);
    define('DB_USER', $env_vars['DB_USER_TEST']);
    define('DB_PASSWORD', $env_vars['DB_PASSWORD_TEST']);
} elseif ($env === 'ci') {
    define('DB_HOST', $env_vars['DB_HOST_CI']);
    define('DB_PORT', $env_vars['DB_PORT_CI']);
    define('DB_DATABASE', $env_vars['DB_DATABASE_CI']);
    define('DB_USER', $env_vars['DB_USER_CI']);
    define('DB_PASSWORD', $env_vars['DB_PASSWORD_CI']);
} else {
    define('DB_HOST', $env_vars['DB_HOST']);
    define('DB_PORT', $env_vars['DB_PORT']);
    define('DB_DATABASE', $env_vars['DB_DATABASE']);
    define('DB_USER', $env_vars['DB_USER']);
    define('DB_PASSWORD', $env_vars['DB_PASSWORD']);
}
// @codeCoverageIgnoreEnd
