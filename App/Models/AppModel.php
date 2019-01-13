<?php

namespace App\Models;

use Core\App;
use Core\DataBase\AbstractModel;

class AppModel extends AbstractModel
{
    public function __construct()
    {
        static::$db = App::$app->getProperty('db');
    }
}