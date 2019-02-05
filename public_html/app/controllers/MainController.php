<?php

namespace app\controllers;
require_once APP . '/controllers/Base.php';
use app\controllers\Base;

class MainController extends Base {

    public function indexAction() {

        if (!isset($_COOKIE['logged_user'])) {
            return header('Location: /login');
        }

    }

}