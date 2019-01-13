<?php

namespace Core\DataBase;

trait THasher {

    public static function hashSecretKey($cdate, $login, $saltKey)
    {
        return md5($cdate . $saltKey . $login);
    }
}