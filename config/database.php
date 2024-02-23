<?php

return [
    /**
     * Recupera il Data Source Name, l'identificativo che rappresenta la connessione specifica ad un database
     */
    'dsn' => $_ENV['DB_CONNECTION'] . ":host=" . $_ENV['DB_HOST'] . ";port=" . $ENV['DB_PORT'] . ";dbname=" . $ENV['DB_NAME'],

    /**
     * Recupera lo user del RDBMS collegato
     */
    'user' => $_ENV['DB_USER'],

    /**
     * Recupera la password dell'RDBMS collegato
     */
    'password' => $_ENV['DB_PASSWORD'],
];
