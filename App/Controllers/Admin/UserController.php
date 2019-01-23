<?php


namespace App\Controllers\Admin;


use App\Models\User;

class UserController extends AdminController
{
    public function indexAction()
    {
        $users = User::findAll();
        $data = [
            'users'      => $users,
            'title_page' => 'Users',
            'title_part' => 'List'
        ];
        return $this->view->render($data);
    }

    public function addAction()
    {
        $data = [
            'title_page' => 'Users',
            'title_part' => 'Add new User'
        ];
        return $this->view->render($data);
    }
}