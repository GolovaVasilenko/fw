<?php

define("DEBUG", 1);

define("ROOT", dirname(__DIR__));

define("WWW", ROOT . "/public");

define("APP", ROOT . "/App");

define("CORE", ROOT . "/Core");

define("LIBS", ROOT . "/Core/libs");

define("CACHE", ROOT . "/tmp/cache");

define("CONF", ROOT . "/config");

define("LAYOUT", "default");

$protocol = "http://";

define("PATH", $protocol . $_SERVER["HTTP_HOST"] . "/");

define("ADMIN", PATH . "admin/");

require_once ROOT . "/vendor/autoload.php";