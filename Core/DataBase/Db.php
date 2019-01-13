<?php


namespace Core\DataBase;


class Db
{
    private $dbh;

    public static $instance = null;

    /**
     * Db constructor.
     */
    private function __construct()
    {
        $connection = require_once CONF . "/db.php";

        $options = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        try{
            $this->dbh = new \PDO(
                $connection['dsn'],
                $connection['user'],
                $connection['password'],
                $options
            );

            if(!$this->dbh)
            {
                throw new \PDOException();
            }
        }
        catch(\PDOException $pdoError){
            echo $pdoError->getMessage();
            die;
        }
    }

    private function __clone(){}

    /**
     * @return Db|null
     */
    public static function getInstance()
    {
        if(self::$instance === null)
            self::$instance = new self;
        return self::$instance;
    }

    /**
     * @param $sql
     * @param string $class
     * @param array $params
     * @return array
     */
    public function query($sql, $class = 'stdClass', $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($params);
        if(false !== $res){
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    /**
     * @param $sql
     * @param array $params
     * @return bool
     */
    public function execute($sql, $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($params);
    }

    /**
     * @return \PDO
     */
    public function getDbh() {
        return $this->dbh;
    }
}