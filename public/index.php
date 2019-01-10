<?php

session_start();

ini_set('display_errors', 1);

include_once __DIR__ . '/../vendor/autoload.php';

require_once  __DIR__ . "/../config/init.php";

require_once CONF . "/routes.php";

require_once LIBS . "/functions.php";

try {

$app = new Core\App(new Core\Request\Request());

}catch(\Exception $e){
    echo $e->getMessage();
}
/*if ( $path_info == '/' )
    $response = new Core\Response\Response('Main page');
else if ( $path_info == 'contact')
    $response = new Core\Response\Response('Contact page');
else
    $response = new Core\Response\Response('<b>Not found 404</b>', 404);


$response->send();*/
