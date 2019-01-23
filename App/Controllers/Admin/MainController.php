<?php


namespace App\Controllers\Admin;


class MainController extends AdminController
{

    public function indexAction()
    {
        $data = [
            'title_page' => "Dashboard",
            'title_part' => 'statistics'
        ];

        return $this->view->render($data);
    }
}