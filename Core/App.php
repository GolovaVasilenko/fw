<?php

namespace Core;

use Core\Container\Container;
use Core\DataBase\Db;
use Core\Errors\ErrorHandler;
use Core\Response\Response;
use Core\Router\Router;
use Core\Request\Request;

class App
{
    public static $app;

    public static $container;

    public function __construct(Request $request, Container $container)
    {
        self::$app = Registry::instance();

        self::$container = $container;

        self::$app->setProperty('query', $request->getPathInfo());
        self::$app->setProperty('db', Db::getInstance());

        $this->getSettings();

        new ErrorHandler();

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

    public function start()
    {
        $response = new Response(
            Router::dispatch(self::$app->getProperty('query')),
            self::$app->getProperty('code_response')
        );
        $response->send();
    }
}