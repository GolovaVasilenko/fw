<?php

namespace Core;

use Core\Errors\ErrorHandler;
use Core\Router\Router;
use Core\Request\Request;

class App
{
    public static $app;

    public function __construct(Request $request)
    {
        $query = $request->getPathInfo();

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