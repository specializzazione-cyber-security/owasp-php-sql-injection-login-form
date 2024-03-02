<?php

use Dotenv\Dotenv;
use App\Modules\App;
use App\Modules\Test;
use App\Modules\Logger;
use App\Modules\Database;

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
 * Recuperiamo le configurazioni del logger e controlliamo che siano corrette
 */
$log_config = require_once configPath() . "logging.php";

if (empty($log_config)) {
    die("Configurazione del loggin non valida.");
}

/**
 * Creiamo un'istanza di classe Logger
 */
$logger = new Logger($log_config);
$logger->channel('default');

/**
 * Istanziamo la nostra app in modo tale da avere un collante per tutti gli elementi che ci servono per farla funzionare
 */
$app = new App($database, $routes, $logger);

unset($db_config);

/**
 * Ritorniamo l'applicazione
 */
return $app;
