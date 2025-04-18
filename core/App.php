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
        return rtrim($uri, '/') ?: '/';
    }

    public function dispatch($uri, $method)
    {
        $uri = $this->normalize($uri);

        if (isset($this->routes[$method][$uri])) {
            list($controllerName, $methodName) = explode('@', $this->routes[$method][$uri]);

            $controllerPath = BASE_PATH . "/app/Controllers/{$controllerName}.php";

            if (!file_exists($controllerPath)) {
                die("Controller {$controllerName} não encontrado.");
            }

            require_once $controllerPath;

            if (!class_exists($controllerName)) {
                die("Classe {$controllerName} não definida.");
            }

            $controller = new $controllerName();

            if (!method_exists($controller, $methodName)) {
                die("Método {$methodName} não encontrado no controller {$controllerName}.");
            }

            return call_user_func([$controller, $methodName]);
        }

        http_response_code(404);
        echo "404 - Página não encontrada";
    }
}

//  Inicia o roteador
$router = new Router();

//  Carrega as rotas definidas
require_once BASE_PATH . '/routes/web.php';

//  Captura URI e método da requisição
$requestUri = $_GET['url'] ?? '/';
$requestMethod = $_SERVER['REQUEST_METHOD'];

//  Executa a rota correspondente
$router->dispatch($requestUri, $requestMethod);
