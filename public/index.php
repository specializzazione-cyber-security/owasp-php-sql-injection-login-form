<?php

use Dotenv\Dotenv;
use App\Modules\App;

//carico autoload per recuperare le varie classi dei pacchetti installati
require_once __DIR__ . "/../vendor/autoload.php";

//recupero il .env indicando il suo path
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
//crea la superglobal $_ENV
$dotenv->load();

//recupero le configurazioni del database (dsn, user, psw)
$db_config = require_once __DIR__ . "/../config/database.php";

$router = require_once __DIR__ . "/../routes/web.php";

//istanzio la mia applicazione in modo tale da avere sempre in memoria tutto cio' che mi serve per farla funzionare (database, routing ecc)
$app = new App(dirname(__DIR__), $db_config, $router);

//per sicurezza, una volta che abbiamo configurato il db, cancelliamo queste info
unset($db_config);

//prende la richiesta lanciata e la risolve
$app->router::resolve();
