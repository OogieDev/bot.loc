<?php

namespace app\models;

require_once CORE . '/base/Model.php';
use sys\mali\base\Model;

class LoginModel extends Model {

    public function getUserByLoginPass($login, $pass) {

        return \R::getAll("SELECT * FROM users WHERE login = ? and password = ?", [$login, $pass]);
        
    }



}