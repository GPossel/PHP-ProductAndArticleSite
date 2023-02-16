<?php
namespace Repositories;

require __DIR__ . '/../vendor/autoload.php';

use PDO;
use PDOException;
use DateTimeImmutable;
use Repositories\Repository;
use Firebase\JWT\JWT;

class UserRepository extends Repository
{
    function login($username, $password)
    {
        $hasValidCredentials = false;
        $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';

        if(empty($username)){ 
            http_response_code(400);
            die("No username set."); 
        }

        if(empty($password)){ 
            http_response_code(400);
            die("No password set."); 
        }

        try {
            $encryptedPass = sha1($password);
            $stmt = $this->connection->prepare("SELECT id, username, password from users WHERE username = :username and password = :encryptedPass");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':encryptedPass', $encryptedPass);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            $stmt->fetchAll();

            $rows = $stmt->rowCount();
            if($rows > 0)
            {
              $hasValidCredentials = true;
            }
            else {
              $hasValidCredentials = false;
              http_response_code(400);
              die("Wrong username or password."); 
            }

            if ($hasValidCredentials) {
                $issuedAt   = new DateTimeImmutable();
                $expire     = $issuedAt->modify('+6 minutes')->getTimestamp();      // Add 60 seconds
                $serverName = "your.domain.name";
                $username   = $username;                                           // Retrieved from filtered POST data

                $data = [
                    'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
                    'iss'  => $serverName,                       // Issuer
                    'nbf'  => $issuedAt->getTimestamp(),         // Not before
                    'exp'  => $expire,                           // Expire
                    'userName' => $username,                     // User name
                ];

                // Encode the array to a JWT string.
                $jwt = JWT::encode(
                  $data,
                  $secretKey,
                  'HS512'
                );

                return $jwt;
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            $user = $stmt->fetch();

            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function insert($user)
    {
        try {
            $encryptedPass = sha1($user->password);
            $stmt = $this->connection->prepare("INSERT into users (username, email, password) VALUES (?,?,?)");
            $stmt->execute($user->username, $user->email, $encryptedPass);
            $user->id = $this->connection->lastInsertId();
            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function update($user, $id)
    {
        try {
            $encryptedPass = sha1($user->password);
            $stmt = $this->connection->prepare("UPDATE users SET email = ?, username = ?, password = ? WHERE id = ?");
            $stmt->execute([$user->email, $user->username, $encryptedPass, $id]);
            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function delete($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }
}
?>