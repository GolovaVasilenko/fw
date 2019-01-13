<?php

namespace App\Controllers;

use Core\App;
use App\Models\Page;

class PageController extends AppController
{
    public function indexAction()
    {
        $pages = Page::findAll();

        $this->setMeta(App::$app->getProperty("site_name"),"escription");

        return $this->view->render(['name' => 'Alexey']);
    }
}