<?php

use Core\Router\Router;

Router::add('^control-panel$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'Admin']);

Router::add('^control-panel/?(?P<controller>[a-z\-]+)/?(?P<action>[a-z\-]+)?$', ['prefix' => 'Admin']);

Router::add('^$', ['controller' => 'Page', 'action' => 'index']);

Router::add('^(?P<controller>[a-z\-]+)/?(?P<action>[a-z\-]+)?$');