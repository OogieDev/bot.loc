<?php

namespace app\controllers;
require_once CORE . '/base/Controller.php';
require_once CORE . '/base/Model.php';
use sys\mali\base\Controller;
use sys\mali\base\Model;

class Base extends Controller {

    public function __construct($route) {
        
        parent::__construct($route);

    }

    public function checkLogin() {
        if (!isset($_COOKIE['im_logged']) || empty($_COOKIE['im_logged'])) {
            return header('Location:/login/');
        }
    }

}