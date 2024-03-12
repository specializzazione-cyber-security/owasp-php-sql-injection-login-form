<?php

namespace App\routes;

use App\Modules\Http\Controller\ArticleController;
use App\Modules\Http\Controller\PublicController;
use App\Modules\Router\Route;

$route = new Route;

$route::get('/', function () {
    return view('welcome');
});

$route::get('/login', [PublicController::class, 'login']);

$route::post('/login/submit', [PublicController::class, 'tryLogin']);
$route::post('/logout', [PublicController::class, 'logout']);

return $route;
