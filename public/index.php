<?php

session_start();

ini_set('display_errors', 1);

include_once __DIR__ . '/../vendor/autoload.php';

require_once  __DIR__ . "/../config/init.php";

require_once CONF . "/routes.php";

require_once LIBS . "/functions.php";

$app = new Core\App(new Core\Request\Request());
$app->start();