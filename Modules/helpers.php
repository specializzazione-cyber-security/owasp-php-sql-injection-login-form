<?php

if (!function_exists('view')) {
    function view($viewName)
    {
        return include_once __DIR__ . '/../Templates/' . $viewName . '.php';
    }
}
