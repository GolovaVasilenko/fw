<?php

namespace Core\View;


use Core\App;

class View
{
    public $layout;

    public $prefix;

    public $user;

    public $route;

    public $controller;

    public $view;

    public $data = [];

    public $meta = [];

    /**
     * View constructor.
     * @param $route
     * @param string $layout
     * @param string $view
     * @param array $meta
     * @param $data
     */
    public function __construct($route, $layout = '', $view = '', $meta = [], $data)
    {
        $this->route = $route;
        $this->prefix = $route['prefix'];
        $this->controller = $route['controller'];
        $this->view = $view;
        $this->meta = $meta;
        $this->data = array_merge($this->data, $data);

        if($layout === false){
            $this->layout = false;
        }
        else {
            $this->layout = $layout ?: LAYOUT;
        }
    }

    /**
     * @param array $data
     * @param int $code
     * @return string
     * @throws \Exception
     */
    public function render($data = [], $code = 200)
    {
        if(is_array($data)){
            $this->data = array_merge($this->data, $data);
            extract($this->data);
        }

        App::$app->setProperty('code_response', $code);

        $this->prefix = str_replace('\\', '/', $this->prefix);
        $viewFile = APP . "/Views/{$this->prefix}{$this->controller}/{$this->view}.php";

        if(is_file($viewFile)) {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        }
        else {
            throw new \Exception("Файл вида {$viewFile} не найден!", 500); 
        }

        if(false !== $this->layout) {
            $fileLayout = APP . "/Views/layouts/{$this->layout}.php";

            if(is_file($fileLayout)) {
                ob_start();
                require_once $fileLayout;
                $body = ob_get_clean();
                return $body;
            }
            else {
                throw new \Exception("Файл шаблона {$this->layout} не найден", 500);
            }
        }

    }

    /**
     * @param $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getMeta()
    {
        $output = "<title>{$this->meta['title']}</title>" . PHP_EOL;
        $output .= '<meta name="description" content="' . $this->meta['description'] . '"/>' . PHP_EOL;

        return $output;
    }
}