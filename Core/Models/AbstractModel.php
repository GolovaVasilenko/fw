<?php

namespace Core\Models;

use Core\App;
use Core\DataBase\Db;
use Core\Session\Session;
use Valitron\Validator;

abstract class AbstractModel {

    const TABLE = '';

	public $errors = [];

	public $rules = [];

	protected $attributes = [];

	public function __construct()
    {
        Db::instance();
    }

    public function load($data)
    {
        foreach($this->attributes as $name => $value){
            if(isset($data[$name])){
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function save()
    {
        $tbl = \R::dispense(static::TABLE);
        foreach($this->attributes as $name => $value){
            $tbl->$name = $value;
        }
        return \R::store($tbl);
    }

    public function update($id)
    {
        $tbl = \R::load(static::TABLE, $id);
        foreach($this->attributes as $name => $value){
            $tbl->$name = $value;
        }
        return \R::store($tbl);
    }


    public static function delete($id)
    {
        $bean = \R::load(static::TABLE, $id);
        \R::trash($bean);
    }

    /**
     * @param $data
     * @return bool
     */
    public function validate($data)
    {
        Validator::lang('ru');
        $v = new Validator($data);
        $v->rules($this->rules);

        if($v->validate()){
            return true;
        }
        else {
            $this->errors = $v->errors();
            return false;
        }
    }

    public function getErrors()
    {
        $errors = "<ul>";
        foreach($this->errors as $error){
            foreach($error as $item){
                $errors .= "<li>" . $item . "</li>";
            }
        }
        $errors .= "</ul>";
        Session::set('errors', $errors);
    }


    public function __set($key, $value)
    {
        if(property_exists($this, $key)){
            $this->$key = $value;
        }
    }

    public function __get($key)
    {
        if(property_exists($this, $key)){
            return $this->$key;
        }
    }
}