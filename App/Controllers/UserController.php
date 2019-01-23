<?php

namespace App\Controllers;

use App\Models\User;
use Core\Session\Session;
use Core\Cookie\Cookie;

class UserController extends AppController
{
    /**
     * @return string
     * @throws \Exception
     */
    public function loginAction()
    {
        $this->view->setLayout('login-admin');

        if($post = $this->request->post) {
            $user = User::checkout($post['email'], $post['password']);

            if($user){
                $user->auth();
                $this->redirect('/control-panel');
            }
            else {
                Session::set('errors', 'Не верный логин или пароль');
            }
        }
        return $this->view->render();
    }

    public function profileAction()
    {
        echo "Profile";
        die;
        //$this->view->setLayout('profile');

        return $this->view->render();
    }

    public function signupAction()
    {
        if($post = $this->request->post){
            $user = new User();

            $user->addUser($post);

            Session::set('success', 'You success Registration');
            $this->redirect('/user/profile');
        }
        return $this->view->render();
    }

    public function logoutAction()
    {
        Session::remove('currentUser');
        Cookie::removeCookie('user_mem');
        $this->redirect('/');
    }
}