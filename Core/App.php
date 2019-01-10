<?php

namespace Core;

use Core\Errors\ErrorHandler;
use Core\Router\Router;

class App
{
    public static $app;

    public function __construct()
    {
        $uri = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);

        $query = trim($uri, '/');

        self::$app = Registry::instance();

        $this->getSettings();

        new ErrorHandler();

        Router::dispatch($query);
    }

    protected function getSettings()
    {
        $params = require_once CONF . '/settings.php';

        if(!empty($params)){
            foreach($params as $k => $v){
                self::$app->setProperty($k, $v);
            }
        }
    }
}