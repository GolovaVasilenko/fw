<?php

namespace Core\DataBase;

use Core\App;

trait THasher {

    public static function hashSecretKey($email)
    {
        return md5(time() . App::$app->getProperty('salt') . $email);
    }

    public static function hashPassword($password)
    {
        return md5(App::$app->getProperty('salt') . $password);
    }
}