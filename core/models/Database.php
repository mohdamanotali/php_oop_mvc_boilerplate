<?php

namespace Core\Models;

require_once(TRAIT_DIR.'/CommonTrait.php');
use Core\Traits\CommonTrait;
use PDO;
use PDOException;

class Database
{
    use CommonTrait;

    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $connection;
    private $error;

    private $query;
    private $params;

    public function __construct()
    {
        //echo "called database model construct method<br/>";
        $conn = "mysql:host=".$this->dbHost.";dbname=".$this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try
        {
            $this->connection = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        }
        catch (PDOException $e)
        {
            $this->_error($e);
            echo '<h1>unknown database</h1>';
            exit;
        }
    }

    private function _error($e)
    {
        $this->log(['pdo_exception'=>$e->getMessage()]);
        return false;
    }

    public function _execute($query, $params = null)
    {
        try
        {
            $this->statement = $this->connection->prepare($query);
            return $this->statement->execute($params);
        }
        catch (PDOException $e)
        {
            return $this->_error($e);
        }
    }

    public function _fetch()
    {
        try
        {
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }
        catch (PDOException $e)
        {
            return $this->_error($e);
        }
    }

    public function _fetchAll()
    {
        try
        {
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }
        catch (PDOException $e)
        {
            return $this->_error($e);
        }
    }

    public function _rowCount()
    {
        try
        {
            return $this->statement->rowCount();
        }
        catch (PDOException $e)
        {
            return $this->_error($e);
        }
    }
}
