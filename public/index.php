<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', function () { echo 'hello world'; });
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

if (FastRoute\Dispatcher::FOUND !== $routeInfo[0]) {
    echo '404';
    exit(0);
}

$handler = $routeInfo[1];
$params = $routeInfo[2];

$handler(...$params);
