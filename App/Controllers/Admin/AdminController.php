<?php


namespace App\Controllers\Admin;

use App\Controllers\AppController;
use Core\Auth\Auth;


class AdminController extends AppController
{
    public function __construct($route)
    {
        parent::__construct($route);

        if(!Auth::check()) {
            $this->redirect('/user/login');
        }

    }
}