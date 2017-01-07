<?php
/**
 * Created by PhpStorm.
 * User: diljit
 * Date: 22/1/15
 * Time: 10:14 AM
 */
include '_config.php';

class DatabaseManager
{
    protected static $connections = array();

   const PRIMARY_KEY_VIOLATED = '23000';
   const INVALID_FIELDS = 'HY093';
   const INSERT_SUCCESS = true;

    public static function getConnection($name = 'default')
    {

        // Let check if we have this connection initialized
        if (isset(self::$connections[$name])) {
            return self::$connections[$name];
        }

        // If we do not have this connection initialized,
        // let try to create new one
        global $config; // <--- access to global variable $config

        // Check if there is any connection string with this name
        if (isset($config[$name])) {
            $db = new Database($config[$name]);
            self::$connections[$name] = $db;

            return $db;
        }

        // Fail to create connection
        return FALSE;
    }
}

class Database
{
    protected $pdo = null;

    public function __construct($connectionString)
    {
        // Create the pdo connection
        $this->pdo = new PDO($connectionString[0], $connectionString[1], $connectionString[2]);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }

    public function select($query, $param = null)
    {

        $sh = $this->pdo->prepare($query);
        $sh->execute($param);
         if ( $sh->rowCount() > 0 )
             return $sh->fetchAll();
         else
             return false;

    }
    public function getLastInsertId($columnName = null)
    {
            return $this->pdo->lastInsertId($columnName);
    }
    public function delete($query,$param=null)
    {
        $sh = $this->pdo->prepare($query);
        $sh->execute($param);

        return $sh->fetchAll() ? (($sh->rowCount()) > 0) : false ;

    }
    public function insert($query,$param=null)
    {
        try
            {
                $sh = $this->pdo->prepare($query);
                ($sh->execute($param));
                return true;

            }
            catch (PDOException $e)
                {
                    return $e->getCode();
                    //return $e->getMessage();
                }

    }

}

