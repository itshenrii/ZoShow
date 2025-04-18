<?php

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get($uri, $action)
    {
        $this->routes['GET'][$this->normalize($uri)] = $action;
    }

    public function post($uri, $action)
    {
        $this->routes['POST'][$this->normalize($uri)] = $action;
    }

    private function normalize($uri)
    {
        $uri = '/' . trim($uri, '/');
        return $uri;
    }


    public function dispatch($uri, $method)
    {
        $uri = $this->normalize($uri);

        if (isset($this->routes[$method][$uri])) {
            list($controllerName, $methodName) = explode('@', $this->routes[$method][$uri]);

            require_once BASE_PATH . "/app/Controllers/{$controllerName}.php";

            if (!class_exists($controllerName)) {
                die("Erro: Controller {$controllerName} não encontrado.");
            }

            $controller = new $controllerName();

            if (!method_exists($controller, $methodName)) {
                die("Erro: Método {$methodName} não encontrado em {$controllerName}.");
            }

            return call_user_func([$controller, $methodName]);
        }

        echo "404 - Página não encontrada";
    }
}

$router = new Router();
require_once BASE_PATH . '/routes/web.php';

$requestUri = $_GET['url'] ?? '/';
$requestMethod = $_SERVER['REQUEST_METHOD'];



$router->dispatch($requestUri, $requestMethod);
