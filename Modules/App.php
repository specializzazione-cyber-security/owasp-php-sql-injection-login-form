<?php

namespace App\Modules;

use App\Modules\Router\Route;

class App
{
    public static App $app;
    public Route $router;
    public Database $database;
    public $session;
    public $csrf_token;

    public function __construct(Database $database, Route $router)
    {
        $this->database = $database;
        $this->router = $router;
        self::$app = $this;
        $this->session = session_start();
        $this->csrf_token = Csrf::generateToken();
    }
}
