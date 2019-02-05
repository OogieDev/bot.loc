<?php

namespace sys\mali;
require_once CORE . '/Tsingletone.php';
require_once CORE . '/libs/rb-mysql.php';

class Db {

    use Tsingletone;

    protected function __construct() {

        $db = require_once CONFIG . '/config_db.php';
        \R::setup($db['dsn'], $db['username'], $db['password']);
        if (!\R::testConnection()) {
            throw new \Exception('Нет подключения к базе данных', 500);
        } 
    }

}