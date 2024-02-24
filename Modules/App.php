<?php

namespace App\Modules;

class App
{
    public static App $app;
    public Router $router;
    public Database $database;
    public $session;

    public function __construct(Database $database, Router $router)
    {

        $this->database = $database;
        $this->router = $router;
        self::$app = $this;
        $this->session = session_start();
    }
}
