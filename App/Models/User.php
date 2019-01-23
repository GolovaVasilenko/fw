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

    public static function checkout($email, $password)
    {
        $passHash = self::hashPassword($password);
        $user = self::getUserByEmail($email);

        if($user && self::findByColumn('password', $passHash)) {
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
        Session::set('currentUser', $this->id);
        $secretKey = User::hashSecretKey($this->email);
        $this->secret_key = $secretKey;

        $this->save();

        Cookie::setCookie('user_mem', $secretKey);
    }

    public function addUser($post)
    {
        $post['confirmed'] = rand(10000, 999999);
        $post['password'] = User::hashPassword($post['password']);
        $post['secret_key'] = User::hashSecretKey($post['email']);
        $post['create_date'] = date("Y-m-d H:i:s");
        $post['avatar'] = '/assets/img/no-avatar.png';

        $this->dataInit($post);
        $this->save();
    }
}