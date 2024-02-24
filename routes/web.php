<?php

namespace App\routes;

use App\Modules\Router\Route;
use App\Modules\Models\Article;

$route = new Route;

$route::get('/', function () {
    return view('welcome');
});

$route::get('/article/create', function () {
    return view('article/create');
});

$route::post('/article/store', function () {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $body = $_POST['body'];

    $article = new Article($title, $subtitle, $body);

    $article->save();

    return redirect('/');
});

return $route;
