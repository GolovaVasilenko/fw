<?php


namespace App\Controllers\Admin;

use App\Controllers\AppController;
use Core\Auth\Auth;
use App\Models\User;
use Core\Session\Session;


class AdminController extends AppController
{
    public $layout = 'admin';

    public $user;

    public function __construct($route)
    {
        parent::__construct($route);

        if(!Auth::check()) {
            $this->redirect('/user/login');
        }
        $this->user = User::findById(Session::get('currentUser'));
        $this->view->setUser($this->user);
    }
}