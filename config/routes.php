<?php

use Core\Router\Router;

Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);

Router::add('^admin/?(?P<controller>[a-z\-]+)/?(?P<action>[a-z\-]+)?$', ['prefix' => 'admin']);

Router::add('^$', ['controller' => 'Page', 'action' => 'index']);

Router::add('^(?P<controller>[a-z\-]+)/?(?P<action>[a-z\-]+)?$');