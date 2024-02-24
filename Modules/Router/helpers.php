<?php

if (!function_exists('view')) {
    function view($viewName)
    {
        return include_once __DIR__ . '/../../Templates/' . $viewName . '.php';
    }
}

if (!function_exists('redirect')) {
    function redirect($route)
    {
        header("Location: $route", true, 302);
        exit();
    }
}

if (!function_exists('test')) {
    function test()
    {
        echo 'ciao';
    }
}
