<?php

namespace Core\libs;

use Core\Request\Request;

class Pagination
{
    public $currentPage;

    public $perPage;

    public $total;

    public $countPages;

    public $uri;

    public function __construct($page, $perpage, $total)
    {
        $this->perPage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    public function getCountPages()
    {
        return ceil($this->total/$this->perPage) ? : 1;
    }

    public function getCurrentPage($page)
    {
        if(!$page || $page < 1)
            $page = 1;

        if($page > $this->countPages)
            $page = $this->countPages;

        return $page;
    }

    public function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0] . '?';

        if(isset($url[1]) && $url[1] !== ''){
            $params = explode('&', $url[1]);
            foreach($params as $param){
                if(!preg_match('#page=#', $param)){
                    $uri .= "{$param}&amp;";
                }
            }
        }
        return urldecode($uri);
    }

    public function getStart()
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    public function getHtml()
    {
        $back = '';
        $forward = '';
        $startpage = '';
        $endpage = '';
        $page2left = '';
        $page1left = '';
        $page2right = '';
        $page1right = '';

        if($this->currentPage > 1){
            $back = '<li><a class="nav-link" href="' . $this->uri . 'page=' . $this->currentPage - 1 . '">&lt;</a></li>';
        }
        if($this->currentPage < $this->countPages) {
            $forward = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage + 1) ."'>&gt;</a></li>";
        }
        if($this->currentPage > 3) {
            $startpage = "<li><a class='nav-link' href='{$this->uri}page=1'>&laquo;</a></li>";
        }
        if($this->currentPage < ($this->countPages - 2)) {
            $endpage = "<li><a class='nav-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        }
        if($this->currentPage - 2 > 0) {
            $page2left = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage - 2) . "'>" . $this->currentPage - 2 . "</a></li>";
        }
        if($this->currentPage - 1 > 0) {
            $page1left = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage - 1) . "'></a>" . $this->currentPage - 1 . "</li>";
        }
        if($this->currentPage + 1 <= $this->countPages) {
            $page1right = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'></a>" . $this->currentPage + 1 . "</li>";
        }
        if($this->currentPage + 2 <= $this->countPages) {
            $page2right = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage + 2) . "'></a>" . $this->currentPage + 2 . "</li>";
        }
        return "<ul class='pagination'>" . $startpage . $back . $page2left . $page1left . "<li class='active'>" . $this->currentPage . "</li>" . $page1right . $page2right . $forward . $endpage . "</ul>";
    }

    public function __toString()
    {
        if($this->countPages > 1)
            return $this->getHtml();
        return '';
    }
}