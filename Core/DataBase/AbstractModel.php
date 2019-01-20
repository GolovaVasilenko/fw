<?php

namespace Core\DataBase;

use Core\App;
use Core\Session\Session;
use Valitron\Validator;

class AbstractModel
{
    use THasher;
    use TFilter;

    const TABLE = '';

    protected static $db;

    protected $errors = [];

    protected $rules = [];

    /**
     * @param string $order
     * @return array
     */
    public static function findAll($order = 'ASC')
    {
        static::$db = App::$app->getProperty('db');
        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY id ' . $order;
        return static::$db->query($sql, get_called_class() );
    }

    public static function findById($id)
    {
        static::$db = App::$app->getProperty('db');
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        $res = static::$db->query($sql, get_called_class() , ['id' =>  $id]);
        if(!empty($res[0]))
            return  $res[0];
        else
            return [];
    }

    public static function findByColumn($column, $val)
    {
        static::$db = App::$app->getProperty('db');
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE ' . $column . '=:val';
        $res = static::$db->query($sql, get_called_class() , ['val' =>  $val]);
        if(!empty($res[0]))
            return  $res[0];
        else
            return [];
    }

    public static function where($columns)
    {
        $cols = '';
        $keys = array_keys($columns);
        for($i = 0; count($keys) > $i; $i++){
            $cols .= $keys[$i] . '=:' . $keys[$i];
            if(count($keys)-1 != $i) {
                $cols .= ' AND ';
            }
        }

        static::$db = App::$app->getProperty('db');
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE ' . $cols;
        $res = static::$db->query($sql, get_called_class() , $columns);
        if(!empty($res[0]))
            return  $res[0];
        else
            return [];
    }

    protected function insert()
    {
        $columns = [];
        $values = [];
        foreach($this as $k => $v)
        {
            if('id' == $k || 'errors' == $k || 'rules' == $k)
                continue;
            $columns[] = $k;
            $values[':'.$k] = $v;
        }
        $sql = 'INSERT INTO ' . static::TABLE . ' (' . implode(', ', $columns) . ') VALUES (' . implode(', ', array_keys($values)) . ')';

        static::$db = App::$app->getProperty('db');
        $result = static::$db->execute($sql, $values);

        if($result){
            $id = static::$db->getDbh()->lastInsertId();
        }
        else{
            $id = false;
        }
        return $id;
    }

    protected function update()
    {
        $ins = [];
        $dataExec = [];
        foreach($this as $key => $val)
        {
            if(null !== $val && 'errors' !== $key && 'rules' !== $key) {
                $dataExec[':' . $key] = $val;
            }
            if('id' == $key || null === $val || 'errors' == $key || 'rules' == $key){
                continue;
            }
            if(null !== $val){
                $ins[] = $key . ' = :' .$key;
            }

        }

        $sql = 'UPDATE ' . static::TABLE . ' SET ' . implode(', ', $ins) . ' WHERE id = :id';

        static::$db = App::$app->getProperty('db');
        return static::$db->execute($sql, $dataExec);
    }

    public function save()
    {
        if(empty($this->id))
        {
            return $this->insert();
        }
        else{
            return $this->update();
        }
    }

    public function delete()
    {
        static::$db = App::$app->getProperty('db');
        $sql = 'DELETE FROM ' . static::TABLE. ' WHERE id = :id';
        if(isset($this->id))
            return static::$db->execute($sql, array('id' => $this->id));
    }

    public function __isset($name) {
        return isset($this->$name);
    }
    /**
     * @param $arr
     * Наполняет свойства модели данными
     */
    public function dataInit($arr)
    {
        foreach($arr as $k => $v)
        {
            $this->set($k, $v);
        }
    }

    public function get($key)
    {
        if (property_exists($this, $key)) {
            return $this->{$key};
        }
        return null;
    }

    public function set($key, $val)
    {
        if (property_exists($this, $key)) {
            $this->{$key} = $val;
            return true;
        }
        return false;
    }

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