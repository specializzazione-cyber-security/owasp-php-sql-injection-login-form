<?php

/**
 * Restituisce il percorso della root dell'applicazione
 * @return string
 */
if (!function_exists('basePath')) {
    function basePath()
    {
        return dirname(__FILE__, 2) . '/';
    }
}

/**
 * Restituisce il percorso della cartella config
 * @return string
 */
if (!function_exists('configPath')) {
    function configPath()
    {
        return basePath() . "config/";
    }
}

/**
 * Restituisce il percorso della cartella routes
 * @return string
 */
if (!function_exists('routesPath')) {
    function routesPath()
    {
        return basePath() . "routes/";
    }
}

/**
 * Restituisce il percorso della cartella Modules
 * @return string
 */
if (!function_exists('modulesPath')) {
    function modulesPath()
    {
        return basePath() . "Modules/";
    }
}

/**
 * Restituisce il percorso della cartella public
 * @return string
 */
if (!function_exists('publicPath')) {
    function publicPath()
    {
        return basePath() . "public/";
    }
}
