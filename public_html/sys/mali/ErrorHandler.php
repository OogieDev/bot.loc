<?php

namespace sys\mali;

class ErrorHandler {

    public function __construct() {

        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }

        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler($e) {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayErrors('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    private function logErrors($message = '', $file = '', $line = '') {
        error_log("[ " . Date("Y-m-d H:i:s") . " ] Текст ошибки: {$message} || В файле: {$file} || На строке: {$line}", 3, TMP . '/error.log');
    }

    private function displayErrors($errno, $errstr, $errfile, $errline, $response = 404) {

        if ($response == 404 && !DEBUG) {
            require_once WWW . '/errors/404.php';
            die;
        }
        if (DEBUG) {
            require_once WWW . '/errors/dev.php';
        } else {
            require_once WWW . '/errors/prod.php';
        }

        die;

    }

}