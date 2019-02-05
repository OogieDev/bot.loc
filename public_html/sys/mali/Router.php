<?php

namespace sys\mali;

class Router {

    private static $routes;
    private static $route;

    public static function addRoute($regexp, $route = []) {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes() {
        return self::$routes;
    }

    public static function dispatch($url) {
        $url = self::sliceGetParameterQuery($url);
        if (self::matchRoute($url)) {
            $controllerFile = APP . '/controllers/' . self::$route['prefix'] . self::$route['controller'] . 'Controller.php';
            $controllerClass = 'app\\controllers\\' . str_replace('/', '\\', self::$route['prefix'] . self::$route['controller'] . 'Controller');
            if (file_exists($controllerFile)) {
                
                require_once $controllerFile;
                if (class_exists($controllerClass)) {
                    
                    $action = self::$route['action'] . 'Action';
                    $controllerObject = new $controllerClass(self::$route);

                    if (method_exists($controllerObject, $action)) {
                        $controllerObject->$action();
                        $controllerObject->getView();
                    } else {
                        throw new \Exception("Не найден action {$action} контроллера {$controllerClass}");
                    }

                } else {
                    throw new \Exception("Не найден класс контроллера {$controllerClass}", 500);
                }
            } else {
                throw new \Exception("Не найден файл контроллера {$controllerFile}", 404);
            }
        } else {
            throw new \ Exception("Ошибка 404. Нет такого урла", 404);
        }
    }

    public static function matchRoute($url) {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                if (empty($route['prefix'])) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '/';
                }
                self::$route['controller'] = self::makeClassName($route['controller']);
                self::$route['action']     = self::makeActionName($route['action']);
                self::$route['prefix']     = $route['prefix'];
                return true;

            }
        }

        return false;

    }

    private function makeClassName($name) {

        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));

    }

    private function makeActionName($name) {

        return lcfirst(self::makeClassName($name));
    
    }

    private function sliceGetParameterQuery($query) {

        $url = explode('&', $query, 2);
        if (false == strpos($url[0], '=')) {
            return rtrim($url[0], '/');
        }

        return '';

    }


}

