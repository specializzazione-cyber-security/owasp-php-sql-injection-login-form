<?php

namespace App\Modules;

class Router
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
    public static function get($uri, $callback)
    {
        self::$routes['GET'][$uri] = $callback;
    }

    public static function post($uri, $callback)
    {
        self::$routes['POST'][$uri] = $callback;
    }

    public static function put($uri, $callback)
    {
        self::$routes['PUT'][$uri] = $callback;
    }

    public static function delete($uri, $callback)
    {
        self::$routes['DELETE'][$uri] = $callback;
    }

    /**
     * Prende dalla richiesta Metodo e URI e controlla se esiste una rotta corrispondente. Se esiste, assegna la callback e la lancia.
     */
    public static function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        $callback = self::$routes[$method][$uri] ?? null;

        if (!$callback) {
            http_response_code(404);
            return view('errors/404');
        }

        return call_user_func($callback);
    }
}
