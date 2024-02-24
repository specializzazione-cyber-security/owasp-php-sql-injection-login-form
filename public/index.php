<?php

use Dotenv\Dotenv;
use App\Modules\App;
use App\Modules\Database;

/**
 * Definiamo i percorsi piu' importanti
 */
require_once dirname(__FILE__, 2) . "/Modules/path_helpers.php";

/**
 * Registriamo l'autoloader di Composer e le funzioni helpers delle rotte
 */
require_once basePath() . "vendor/autoload.php";
require_once modulesPath() . "Router/helpers.php";

/**
 * Recuperiamo il file .env e controlliamo che esista
 */
$dotenv = Dotenv::createImmutable(basePath());
$dotenv->load();

if (!file_exists(basePath() . '.env')) {
    die("Il file .env non è stato trovato.");
}

/**
 * Recuperiamo le configurazioni del database e controlliamo che siano corrette
 */
$db_config = require_once configPath() . "database.php";

if (empty($db_config)) {
    die("Configurazione del database non valida.");
}

/**
 * Creiamo un'istanza di classe Database
 */
$database = new Database($db_config);

/**
 * Recuperiamo il contenuto del file di routing
 */
$routes = require_once routesPath() . "web.php";

/**
 * Istanziamo la nostra app in modo tale da avere sempre in memoria tutto cio' che ci serve per farla funzionare
 */
$app = new App($database, $routes);

//per sicurezza, una volta che abbiamo configurato il db, cancelliamo queste info
unset($db_config);

//prende la richiesta lanciata e la risolve
$app->router::resolve();
