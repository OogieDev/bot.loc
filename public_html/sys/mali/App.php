<?php

namespace sys\mali;

require_once CORE . '/Regestry.php';
require_once CORE . '/ErrorHandler.php';
require_once CORE . '/Router.php';

class App {
    
    public static $app;

    public function __construct() {
        $query = trim($_SERVER['QUERY_STRING'], '/');
        session_start();
        error_reporting(E_ALL);
        self::$app = Regestry::getInstance();
        self::$app->setProperty('get', $_GET);
        self::$app->setProperty('post', $_POST);
        self::$app->setProperty('sever', $_SERVER);
        new ErrorHandler();
        require_once CONFIG . '/routes.php';
        Router::dispatch($query);
        
    }

}