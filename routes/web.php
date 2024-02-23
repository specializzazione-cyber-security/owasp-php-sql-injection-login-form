<?php

namespace App\routes;

use App\Modules\Router;
use App\Modules\Models\Article;

$router = new Router();

//nella chiave get registro questo nuovo uri con la callback corrispondente
$router::get('/', function () {
    return view('welcome');
});

$router::get('/article/create', function () {
    return view('article/create');
});

$router::post('/article/store', function () {
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $body = $_POST['body'];

    $article = new Article($title, $subtitle, $body);

    $article->save();

    return redirect('/');
});

return $router;
