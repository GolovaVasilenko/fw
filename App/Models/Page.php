<?php

namespace App\Models;


class Page extends AppModel
{
    const TABLE = 'pages';

    public $id;

    public $title;

    public $slug;

    public $body;
}