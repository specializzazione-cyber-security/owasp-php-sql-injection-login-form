<?php

namespace App\Modules;

//deve contenere istanza del router e un'istanza del DB
class App
{
    public static $root;
    public static App $app;
    public Router $router;
    public Database $database;
    public $session;

    public function __construct($root, array $database, Router $router)
    {
        $this->database = new Database($database);
        $this->router = $router;
        self::$app = $this;
        $this->session = session_start();
    }
}
