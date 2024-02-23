<?php

namespace App\routes;

use App\Modules\Csrf;
use App\Modules\Router;
use App\Modules\Models\Article;

$router = new Router();

//nella chiave get registro questo nuovo uri con la callback corrispondente
$router::get('/', function () {
    return include_once __DIR__ . '/../Templates/welcome.php';
});

$router::get('/article/create', function () {
    return include_once __DIR__ . '/../Templates/article/create.php';
});

$router::post('/article/store', function () {

    $requestToken = $_POST['csrf_token'];

    if (!Csrf::verifyToken($requestToken)) {
        http_response_code(419);
        die('<h1>419 Pagina Scaduta</h1><p>La pagina è scaduta a causa di una richiesta non valida.</p>');
    }

    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $body = $_POST['body'];

    $article = new Article($title, $subtitle, $body);

    $article->save();

    header('Location: http://localhost:8000');
    exit();
});

return $router;
