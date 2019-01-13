<?php

namespace App\Controllers;

use Core\App;

class MainController extends AppController
{
    public function indexAction()
    {
        $this->setMeta(App::$app->getProperty("site_name"),"escription");
        $this->set(['name' => 'Alexey']);

        return $this->view->render(['name' => 'Alexey']);
    }
}