<?php

namespace sys\mali\base;

class View {

    public $route = [];
    protected $title = '';
    protected $description = '';
    protected $keywords = '';
    public $controller;
    public $view;
    public $model;
    public $layout;
    public $prefix;

    public function __construct($route, $layout = '', $view = '', $meta_title, $meta_description, $meta_keywords) {

        $this->route = $route;
        $this->view = $view;
        $this->title = $meta_title;
        $this->description = $meta_description;
        $this->keywords = $meta_keywords;
        $this->prefix = $route['prefix'];

        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ? $layout : LAYOUT;
        }

    }

    public function getMeta() {
        $meta = "";
        if (!empty($this->description)) {
            $meta .= "<meta name=\"description\" content=\"{$this->description}\">\n";
        }
        if (!empty($this->keywords)) {
            $meta .= "\t<meta name=\"keywords\" content=\"{$this->keywords}\">\n";
        }
        if (!empty($this->title)) {
            $meta .= "\t<title>{$this->title}</title>\n";
        }
        return $meta;
    }

    public function render($data) {

        if (is_array($data)) {
            extract($data);
        }
        
        $viewFile = APP . "/views/{$this->route['controller']}/{$this->prefix}{$this->view}.php";
        if (is_file($viewFile) && $this->layout !== false) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();

        } elseif (is_file($viewFile) && $this->layout === false) {
            
            require_once $viewFile;
            return;
        
        } else {
            throw new \Exception("Не найден вид {$viewFile}", 500);
        }

        $templateFile = APP . "/views/templates/{$this->prefix}{$this->layout}.php";

        if (is_file($templateFile)) {
            require_once $templateFile;
        } else {
            throw new \Exception("Не найден шаблон {$templateFile}", 500);
        }

    }


}