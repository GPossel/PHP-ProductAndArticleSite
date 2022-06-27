<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class ArticleRepository extends Repository
{
    function getAll($offset = NULL, $limit = NULL)
    {
        try {
            $query = "SELECT * FROM articles";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Article');
            $articles = $stmt->fetchAll();

            return $articles;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM articles WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Article');
            $article = $stmt->fetch();

            return $article;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function insert($article)
    {
     if(ValidateUser()){
            try {
                $d = time();
                $stmt = $this->connection->prepare("INSERT into articles (title, date, writer, innerText, `fullText`) VALUES (?,?,?,?,?)");
                $stmt->execute([$article->title, date("Y-m-d  H:i:s", $d), $article->writer, $article->innerText, $article->fullText]);
                $article->id = $this->connection->lastInsertId();

                return $article;
            } catch (PDOException $e) {
                echo $e;
            }
     }
    }


    function update($article, $id)
    {
        if(ValidateUser()){
            try {
                $stmt = $this->connection->prepare("UPDATE articles SET title = ?, date=?, writer = ?, innerText = ?, fullText = ? WHERE id = ?");

                $stmt->execute([$article->title, now(), $article->writer, $article->innerText, $article->fullText, $id]);

                return $article;
            } catch (PDOException $e) {
                echo $e;
            }
        }
    }

    function delete($id)
    {
        if(ValidateUser()){
            try {
                $stmt = $this->connection->prepare("DELETE FROM articles WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                return;
            } catch (PDOException $e) {
                echo $e;
            }
            return true;
        }
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
            $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
            $decoded = JWT::decode($jwt, new Key($secretKey, 'HS512'));
            // username is now found
            // echo $decoded->data->username;
            }
            catch(\Firebase\JWT\ExpiredException $e)
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
