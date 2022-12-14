<?php

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'App\Controllers\NewsController@index');

    $r->addRoute('GET', '/userArticles', 'App\Controllers\UserArticlesController@displayUserArticles');

    $r->addRoute('GET', '/addArticle/create', 'App\Controllers\UserArticlesController@create');
    $r->addRoute('POST', '/addArticle', 'App\Controllers\UserArticlesController@store');
});

//Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        print_r("404 Not Found");
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        print_r("405 Method Not Allowed");
        break;
    case FastRoute\Dispatcher::FOUND:

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = explode("@", $handler);

        $loader = new \Twig\Loader\FilesystemLoader('app/Views');
        $twig = new \Twig\Environment($loader);

        $container = new DI\Container();
        $container->set(\app\Repositories\RepositoryInterface::class, DI\create(\App\Repositories\NewsApiRepository::class));

        /** @var \App\View $view */
        $view = ($container->get($controller))->$method();

        if ($view) {
            $template = $twig->load($view->getTemplatePath());
            echo $template->render($view->getData());
        }

        break;
}