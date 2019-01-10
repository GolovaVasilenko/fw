<?php

namespace App\Controllers;

//use App\AppModel;
//use app\models\CategoryModel;
use Core\App;
use Core\Controllers\AbstractController;
use Core\Cache\Cache;

class AppController extends AbstractController
{
    public function __construct($route)
    {
        parent::__construct($route);

        //new AppModel();

        //App::$app->setProperty('cats', self::cacheCategory());
    }

    /*public static function cacheCategory()
    {
        $cats = Cache::get('cats');
        if(!$cats) {
            $cats = CategoryModel::getAllCategories();
            Cache::set('cats', $cats);
        }

        return $cats;
    }*/
}