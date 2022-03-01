<?php
require_once __DIR__.'/../config.php';

class Db
{
    private static $instance = NULL;
    private $db;

    private function __construct()
    {
        $this->db = new PDO(DB_TYPE.':host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_BASE.';charset='.DB_CHARSET,
            DB_USER,
            DB_PASS,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public static function getInstance(){
        if (is_null(Db::$instance)){
            Db::$instance = new Db;
        }
        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }
}