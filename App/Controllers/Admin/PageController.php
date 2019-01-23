<?php


namespace App\Controllers\Admin;


use App\Models\Page;

class PageController extends AdminController
{
    public function indexAdmin()
    {
        return $this->view->render([
            'pages' => Page::findAll('DESC'),
        ]);
    }

    public function addAction()
    {
        return $this->view->render();
    }
}