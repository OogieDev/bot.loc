<?php

namespace sys\mali\base;

require_once CORE . '/Db.php';
use sys\mali\Db;

class Model {

    public function __construct() {
        
        Db::getInstance();

    }        

}