<?php

namespace Core\Controllers;

use Core\App;
use Core\DataBase\Db;
use Core\Session\Session;

abstract class AbstractController
{
    public $route;

    public $controller;

    public $view;

    public $prefix;

    public $model;

    public $layout;

    public $data = [];

    public $meta = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];

        if($errors = Session::get('errors')) {
            if(Session::get('old')) {
                $old = Session::get('old');
            }
            $this->set([ 'errors' => $errors, 'old_data' => $old ]);
            Session::remove('old');
            Session::remove('errors');
        }

        if($success = Session::get('success')) {
            $this->set([ 'success' => $success ]);
            Session::remove('success');
        }
    }

    public function set($data)
    {
        $this->data = $data;
    }


    public function setMeta($title = '', $desc = '', $kw = '')
    {
        $this->meta['title'] = $title;
        $this->meta['description'] = $desc;
        $this->meta['keywords'] = $kw;
    }

    public function getView()
    {    
        $viewObj = new View($this->route, $this->layout, $this->view, $this->meta);
        $viewObj->render($this->data);
    }

    public function redirect($path)
    {
        header("Location: " . $path);
        die;
    }

    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function getRequestID($get = true, $id = 'id')
    {
        if($get){
            $data = $_GET;
        }
        else {
            $data = $_POST;
        }
        return !empty($data[$id]) ? $data[$id] : null;
    }
}