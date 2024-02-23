<?php

namespace App\Modules;

//deve contenere istanza del router e un'istanza del DB oltre alla sessione
class App
{
    public static $root;
    public static App $app;
    public Router $router;
    public Database $database;
    public $session;

    public function __construct($root, Database $database, Router $router)
    {
        $this->database = $database;
        $this->router = $router;
        self::$app = $this;
        $this->session = session_start();
    }
}
