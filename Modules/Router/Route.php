<?php

namespace App\Modules\Router;

use App\Modules\Csrf;
use Closure;

class Route
{
    //routes ha al suo interno i vari metodi
    protected static array $routes = [
        'GET' => [],
        'POST' => [],
        'PUT' => [],
        'DELETE' => [],
    ];

    /**
     * Assegna in routes, per quel metodo, per quell'uri una callback
     */
    public static function get(string $uri, Closure|array $callback): void
    {
        self::$routes['GET'][$uri] = $callback;
    }

    public static function post(string $uri, Closure|array $callback): void
    {
        self::$routes['POST'][$uri] = $callback;
    }

    public static function put(string $uri, Closure|array $callback): void
    {
        self::$routes['PUT'][$uri] = $callback;
    }

    public static function delete(string $uri, Closure|array $callback): void
    {
        self::$routes['DELETE'][$uri] = $callback;
    }

    public static function routeIs(string $uri): bool
    {
        return $uri == parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * Prende dalla richiesta Metodo e URI e controlla se esiste una rotta corrispondente. Se esiste, assegna la callback e la lancia.
     */
    public static function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($method === 'POST') {
            if (!isset($_POST['csrf_token']) || !Csrf::verifyToken($_POST['csrf_token'])) {
                http_response_code(419);
                return view('errors/419');
            }
        }

        $callback = self::$routes[$method][$uri] ?? null;

        if (!$callback) {
            http_response_code(404);
            return view('errors/404');
        }

        if (is_array($callback) && count($callback) === 2) {
            $controller = new $callback[0]();
            $methodName = $callback[1];
            return $controller->call($methodName, []);
        } elseif ($callback instanceof Closure) {
            return $callback();
        }
    }
}
