<?php

namespace app\controllers;
require_once APP . '/controllers/Base.php';
use app\controllers\Base;

class LoginController extends Base {

    public function indexAction() {

        if (isset($_COOKIE['im_logged']) && !empty($_COOKIE['im_logged'])) {
            return header('Location:/admin/');
        }

        $this->setTitle('Страница авторизации');
        $this->data['action'] = "/login";


        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->layout = false;
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            var_dump($_POST);

            $user = $this->self_model->getUserByLoginPass($_POST['login'], $_POST['password']);
            if ($user) {
                echo 'setcookie';
                setcookie('im_logged', md5($user['login']), time() + 3600 * 24 * 7);
            } else {
                echo 'nine';
            }

        }

    }

}