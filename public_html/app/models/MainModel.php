<?php

namespace app\models;

require_once CORE . '/base/Model.php';
use sys\mali\base\Model;

class MainModel extends Model {

    public function getUsers() {

        return \R::findAll('users');

    }



}