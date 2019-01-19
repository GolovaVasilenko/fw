<?php

namespace App\Controllers;

use App\Models\User;
use Core\Session\Session;

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
        //$this->view->setLayout('profile');

        return $this->view->render();
    }

    public function signupAction()
    {
        if($post = $this->request->post){
            var_dump($post);
            die;
        }
        return $this->view->render();
    }

    public function logoutAction()
    {

    }
}