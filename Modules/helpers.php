<?php

/**
 * Restituisce il percorso della root dell'applicazione.
 * Se viene passata una stringa, crea un percorso totalmente qualificato
 * @param string|null $path
 * @return string
 */
if (!function_exists('basePath')) {
    function basePath(?string $path = null): string
    {
        return dirname(__FILE__, 2) . '/' . $path;
    }
}

/**
 * Restituisce il percorso della cartella config.
 * Se viene passata una stringa, crea un percorso totalmente qualificato
 * @param string|null $path
 * @return string
 */
if (!function_exists('configPath')) {
    function configPath(?string $path = null): string
    {
        return basePath() . "config/" . $path;
    }
}

/**
 * Restituisce il percorso della cartella routes.
 * Se viene passata una stringa, crea un percorso totalmente qualificato
 * @param string|null $path
 * @return string
 */
if (!function_exists('routesPath')) {
    function routesPath(?string $path = null): string
    {
        return basePath() . "routes/" . $path;
    }
}

/**
 * Restituisce il percorso della cartella Modules.
 * Se viene passata una stringa, crea un percorso totalmente qualificato
 * @param string|null $path
 * @return string
 */
if (!function_exists('modulesPath')) {
    function modulesPath(?string $path = null): string
    {
        return basePath() . "Modules/" . $path;
    }
}

/**
 * Restituisce il percorso della cartella public.
 * Se viene passata una stringa, crea un percorso totalmente qualificato
 * @param string|null $path
 * @return string
 */
if (!function_exists('publicPath')) {
    function publicPath(?string $path = null): string
    {
        return basePath() . "public/" . $path;
    }
}

/**
 * Restituisce il CSRF Token presente in sessione
 * @return string
 */
if (!function_exists('csrfToken')) {
    function csrfToken(): string
    {
        return $_SESSION['csrf_token'];
    }
}
