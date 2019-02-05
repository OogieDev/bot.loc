<?php

namespace sys\mali\base;

require_once CORE . '/base/View.php';

abstract class Controller {

    public $route = [];
    protected $title = '';
    protected $description = '';
    protected $keywords = '';
    public $controller;
    public $view;
    public $model;
    public $layout;
    public $prefix;
    public $data = [];


    public function __construct($route) {
        $this->route        = $route;
        $this->controller   = $route['controller'];
        $this->view         = $route['action'];
        $this->model        = $route['controller'];
        $this->prefix       = $route['prefix'];
        $this->getModel();
    }

    public function setTitle($title) {
        $this->title = $title;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    public function getView() {
        $viewObject = new View($this->route, $this->layout, $this->view, $this->title, $this->description, $this->keywords);
        $viewObject->render($this->data);
    }

    protected function getModel() {

        $modelFile = APP . "/models/{$this->route['prefix']}{$this->model}Model.php";

        if (is_file($modelFile)) {
            require_once $modelFile;
            $modelClass = 'app\\models\\' . str_replace('/', '\\', $this->route['prefix']) . $this->model . "Model";
            if (class_exists($modelClass)) {
                $this->self_model = new $modelClass();
            } else {
                throw new \Exception('Не найден класс модели ' . $modelClass, 500);
            }
        } 
    }

}