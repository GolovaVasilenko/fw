<?php


namespace App\Models;


use App\Controllers\Auth;
use Core\Cookie\Cookie;
use Core\App;
use Core\Session\Session;

class User extends AppModel
{
    const TABLE = 'users';

    public $id;
    public $email;
    public $login;
    public $password;
    public $secret_key;
    public $create_date;
    public $avatar;
    public $confirmed;


    public function getUserById($user_id)
    {
        return self::findById($user_id);
    }

    public static function getUserByEmail($email)
    {
        return self::findByColumn('email', $email);
    }

    public static function isAuth()
    {
        if(!empty(Session::get('currentUser'))) {
            return true;
        } else if(User::checkByCookie()) {
            return true;
        }
        return false;
    }

    public static function getUserBySecret($secret)
    {
        return self::findByColumn('secret_key', $secret);
    }

    public static function checkout($email, $passHash)
    {
        if($user = self::getUserByEmail($email) && self::findByColumn('password', $passHash)) {
            return $user;
        }
        return false;
    }

    public static function checkByCookie()
    {
        if(
            !empty(Cookie::getCookie('user_mem')) &&
            $user = self::getUserBySecret(Cookie::getCookie('user_mem')))
        {
            $user->auth();
            return $user;
        }
        return false;
    }

    public function auth()
    {
        Session::set('currentUser', $user->id);
        $secretKey = User::hashSecretKey($user->email);
        $user->secret_key = $secretKey;
        $user->save();

        Cookie::setCookie('user_mem', $secretKey);
    }

}