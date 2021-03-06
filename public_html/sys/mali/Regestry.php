<?php

namespace sys\mali;

require_once CORE . '/Tsingletone.php';

class Regestry {

    use Tsingletone;

    private static $properties;

    public function setProperty($key, $value) {
        self::$properties[$key] = $value;
    }

    public function getProperty($key) {
        if (isset(self::$properties[$key])) {
            return self::$properties[$key];
        } else {
            return null;
        }
    }

    public function getProperties() {
        return self::$properties;
    }

}