<?php

namespace App\routes;

use App\Modules\Csrf;
use App\Modules\Router;
use App\Modules\Models\Article;

require_once __DIR__ . '/../Modules/helpers.php';

$router = new Router();

//nella chiave get registro questo nuovo uri con la callback corrispondente
$router::get('/', function () {
    return view('welcome');
});

$router::get('/article/create', function () {
    return view('article/create');
});

$router::post('/article/store', function () {

    $requestToken = $_POST['csrf_token'];

    if (!Csrf::verifyToken($requestToken)) {
        http_response_code(419);
        return view('errors/419');
    }

    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $body = $_POST['body'];

    $article = new Article($title, $subtitle, $body);

    $article->save();

    return view('welcome');
    exit();
});

return $router;
