<?php


namespace Core\Request;


class Request
{
    public $get = [];
    public $post = [];
    public $request = [];
    public $cookie = [];
    public $files = [];
    public $server = [];

    protected $uri = '';

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->request = $_REQUEST;
        $this->cookie = $_COOKIE;
        $this->server = $_SERVER;
    }

    /**
     * @return string
     */
    public function getPathInfo() {

        $request_uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $query_string = $_SERVER['QUERY_STRING'];
        $script_name = $_SERVER['SCRIPT_NAME'];

        $path_info = str_replace(
            '?' . $query_string,
            '', $request_uri);

        $path_info = str_replace(
            $script_name,
            '', $path_info);
        $path_info = trim($path_info, '/');

        $this->uri = empty($path_info) ? '' : $path_info;
        return $this->uri;
    }

    /**
     * @param $key
     * @return array
     */
    public function getQueryItem($key)
    {
        return isset($this->get[$key]) ? $this->get[$key] : [];
    }

    /**
     * @return bool
     */
    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    /**
     * @param $key
     * @return array
     */
    public function getPostItem($key)
    {
        return isset($this->post[$key]) ? $this->post[$key] : [];
    }
}