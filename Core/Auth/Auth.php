<?php

namespace Core\Auth;

use App\Models\User;

class Auth
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->user->auth();
    }

    public static function check()
    {
        return User::isAuth();
    }


}