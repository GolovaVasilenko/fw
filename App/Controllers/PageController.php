<?php

namespace App\Controllers;

use Core\App;
use App\Models\Page;

class PageController extends AppController
{
    public function indexAction()
    {
        $pages = Page::findAll();
        var_dump($pages);
        $this->setMeta(App::$app->getProperty("site_name"),"escription");
        $this->set(['name' => 'Alexey']);

        return $this->view->render(['name' => 'Alexey']);
    }
}