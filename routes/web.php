<?php

namespace App\routes;

use App\Modules\Http\Controller\ArticleController;
use App\Modules\Http\Controller\PublicController;
use App\Modules\Router\Route;

$route = new Route;

$route::get('/', [PublicController::class, 'homepage']);

$route::get('/article/index', [ArticleController::class, 'index']);
$route::get('/article/create', [ArticleController::class, 'create']);
$route::post('/article/store', [ArticleController::class, 'store']);
// $route::get('/article/edit/' . $article['id'], [ArticleController::class, 'edit']);

return $route;
