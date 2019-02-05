<?php
require_once CORE . '/Router.php';

use sys\mali\Router;

Router::addRoute('^admin/?$', ['controller' => 'Dashboard', 'action' => 'index', 'prefix' => 'admin']);
Router::addRoute('^admin/?(?P<controller>[a-z-]+)?/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);
Router::addRoute('^api/?$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'api']);
Router::addRoute('^api/?(?P<controller>[a-z-]+)?/?(?P<action>[a-z-]+)?$', ['prefix' => 'api']);
Router::addRoute('^login/?$', ['controller' => 'Login', 'action' => 'index']);
Router::addRoute('(.*)', ['controller' => 'Main', 'action' => 'index']);