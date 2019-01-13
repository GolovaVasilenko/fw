<?php

namespace App\Models;


use Core\DataBase\AbstractModel;

class Page extends AbstractModel
{
    const TABLE = 'pages';

    public $id;

    public $title;

    public $slug;

    public $body;
}