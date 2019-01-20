<?php

namespace Core\Controllers;

use Core\App;
use Core\DataBase\Db;
use Core\Request\Request;
use Core\Session\Session;
use Core\View\View;

abstract class AbstractController
{
    public $route;

    public $controller;

    public $view_temp;

    public $view;

    public $prefix;

    public $model;

    public $layout;

    public $data = [];

    public $request;

    public $meta = [
        'title' => '',
        'description' => ''
    ];

    /**
     * AbstractController constructor.
     * @param $route
     */
    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view_temp = $route['action'];
        $this->prefix = $route['prefix'];
        $this->request = new Request();

        if($errors = Session::get('errors')) {
            if(Session::get('old')) {
                $old = Session::get('old');
                $this->set([ 'errors' => $errors, 'old_date' => $old ]);
            }

            Session::remove('old');
            Session::remove('errors');
        }

        if($success = Session::get('success')) {
            $this->set([ 'success' => $success ]);
            Session::remove('success');
        }

        $this->view = $this->getView();
    }

    /**
     * @param $data
     */
    public function set($data)
    {
        $this->data = $data;
    }

    /**
     * @param string $title
     * @param string $desc
     */
    public function setMeta($title = '', $desc = '')
    {
        $this->meta['title'] = $title;
        $this->meta['description'] = $desc;
    }

    /**
     * @return View
     */
    public function getView()
    {    
        return new View(
                    $this->route,
                    $this->layout,
                    $this->view_temp,
                    $this->meta,
                    $this->data
                );
    }

    public function redirect($path)
    {
        header("Location: " . $path);
        die;
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