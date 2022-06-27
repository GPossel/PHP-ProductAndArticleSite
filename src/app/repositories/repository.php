<?php
namespace Repositories;

use PDO;
use PDOException;

class Repository {

    protected $connection;

    function __construct() {

        require __DIR__ . '/../dbconfig.php';

        try {
            // $this->connection = new PDO("$type:host=$servername;dbname=$database", $username, $password);
            $this->connection = new PDO("mysql:host=mysql;port=3307;dbname=vuedb;", "developer", "secret123");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            throw new \PDOException("Connection failed: " . $e->getMessage());
          }
    }       

    public function getConnection()
    {
        return $this->connection;
    }

}