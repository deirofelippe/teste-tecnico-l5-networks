<?php

require_once __DIR__ . '/utils/RequireAll.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$query_string = $_SERVER['QUERY_STRING'] ?? '';
$query_string = get_logs_query_string($query_string);

load_if_is_static_file($uri);

function load_if_is_static_file(string $uri)
{
    $pattern = '/(.css)$/i';
    $is_static_file = preg_match($pattern, $uri);

    if ($is_static_file) {
        header('Content-Type: text/css');
        include_once __DIR__ . "/views/$uri";
        exit(0);
    }
}

function is_same_uri($request_uri, $registered_uri)
{
    $request_uri = explode('?', $request_uri)[0];

    $pattern_uri = preg_replace("/\//", "\/", $registered_uri);
    $pattern_uri = preg_replace("/{[\w]+}/", "[\w]+", $pattern_uri);
    $is_same = preg_match("/^$pattern_uri$/i", $request_uri);

    return $is_same;
}

function extract_path_variable($request_uri, $registered_uri)
{
    $matches = [];

    $pattern_uri = preg_replace('/\//', '\/', $registered_uri);
    $pattern_uri = preg_replace("/{[\w]+}/", "([\w]+)", $pattern_uri);

    preg_match("/$pattern_uri/i", $request_uri, $matches);

    return $matches[1];
}

function get_logs_query_string(string $query_string)
{
    if ($query_string == '') {
        return '';
    }

    $arr = explode('&', $query_string);
    $limit = explode('=', $arr[0]);
    $offset = explode('=', $arr[1]);

    return [
        'limit' => $limit[1],
        'offset' => $offset[1],
    ];
}

$pdo = DatabaseSingleton::getInstance();
$logs_repository = new LogsRepository($pdo);
$logger = new Logger($logs_repository);
$http_client = new HttpClient($logger);
$cache = new Cache($logger);

$init_find_film_by_id = function (string $request_uri, string $registered_uri) use ($http_client, $logger, $cache, $pdo) {
    $comments_repository = new CommentsRepository($pdo, $logger);
    $service = new FindFilmByIdService($http_client, $logger, $cache, $comments_repository);
    $controller = new FindFilmByIdController($service);

    $id = extract_path_variable($request_uri, $registered_uri);

    $controller->execute($id);
};

$init_find_all_films = function (string $uri) use ($httpClient, $logger, $cache) {
    $service = new FindAllFilmsService($httpClient, $logger, $cache);
    $controller = new FindAllFilmsController($service);

    $controller->execute();
};

$init_logs = function (string $uri) use ($logsRepository, $logger, $query_string) {
    $service = new ShowLogsService($logsRepository, $logger);
    $controller = new ShowLogsController($service);

    $limit = '10';
    $offset = '0';

    if ($query_string != '') {
        $limit = $query_string['limit'];
        $offset = $query_string['offset'];
    }

    $controller->execute($limit, $offset);
};

$routes = [
    '/' => $init_find_all_films,
    '/film/{id}' => $init_find_film_by_id,
    '/logs' => $init_logs,
];

foreach ($routes as $path => $function) {
    if (!is_same_uri($uri, $path)) {
        continue;
    }

    $function($uri, $path);
}
