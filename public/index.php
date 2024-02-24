<?php

use Dotenv\Dotenv;
use App\Modules\App;
use App\Modules\Database;

//carico autoload per recuperare le varie classi dei pacchetti installati
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../Modules/helpers.php";

//definisco i percorsi dei file
define('BASE_PATH', __DIR__ . "/../");
define('CONFIG_PATH', BASE_PATH . "config/");
define('ROUTES_PATH', BASE_PATH . "routes/");

//recupero il .env indicando il suo path
$dotenv = Dotenv::createImmutable(BASE_PATH);
//crea la superglobal $_ENV
$dotenv->load();

if (!file_exists(BASE_PATH . '.env')) {
    die("Il file .env non è stato trovato.");
}

//recupero le configurazioni del database (dsn, user, psw)
$db_config = require_once CONFIG_PATH . "database.php";

if (empty($db_config)) {
    die("Configurazione del database non valida.");
}

$database = new Database($db_config);

$router = require_once ROUTES_PATH . "web.php";

//istanzio la mia applicazione in modo tale da avere sempre in memoria tutto cio' che mi serve per farla funzionare (database, routing ecc)
$app = new App($database, $router);

//per sicurezza, una volta che abbiamo configurato il db, cancelliamo queste info
unset($db_config);

//prende la richiesta lanciata e la risolve
$app->router::resolve();
