<?php
namespace Repositories;

use Exception;
use PDO;
use PDOException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class Repository {

    protected $connection;

    function __construct() {
      require __DIR__ . '/../dbconfig.php';

        try {
            $this->connection = new PDO("$type:host=$servername;dbname=$database", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
    }       

    public function getConnection()
    {
        return $this->connection;
    }

    
    function ValidateUser() {
      if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
          header('WWW-Authenticate: "localhost:8080/"');
          header('HTTP/1.0 401 Unauthorized');
          echo 'Not allowed';
          exit;
      }
  
      // read from header JWT
          $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
          $arr = explode(" ", $authHeader);
          if(isset($arr[1]))
              $jwt = $arr[1];
          
          if(empty($jwt)) { 
          header('HTTP/1.0 401 Unauthorized'); 
          echo "Only authorized people can do this. Please login.";
          exit;
          }
      
      if($jwt) {
              try {
              require __DIR__ . '/../vendor/autoload.php';
  
              $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
              $decoded = JWT::decode($jwt, new Key($secretKey, 'HS512'));
              // username is now found
              // echo $decoded->data->username;
              }
              catch(ExpiredException $e)
              {
              header('WWW-Authenticate: "localhost:8080/"');
              header('HTTP/1.0 401 Unauthorized');
              echo 'Token expired. Please login again.';
              exit;
              } 
              catch (Exception $e)
              {
              header('WWW-Authenticate: "localhost:8080/"');
              header('HTTP/1.0 401 Unauthorized');
              echo 'Not allowed';
              exit;
              }
          }
      
          return true;
      }

}
?>