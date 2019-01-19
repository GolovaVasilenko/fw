<?php


namespace App\Controllers\Admin;


class MainController extends AdminController
{
    public function indexAction()
    {
        return $this->view->render();
    }
}