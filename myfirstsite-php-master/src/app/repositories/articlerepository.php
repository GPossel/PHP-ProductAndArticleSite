<?php
namespace Repositories;

use PDO;
use PDOException;
use Exception;
use Repositories\Repository;

class ArticleRepository extends Repository
{
    function getTest()
    {
        return print('test-articlerepo');
    }

    function getAll($offset, $limit)
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
        if($this->ValidateUser()){
            try {
                $stmt = $this->connection->prepare("INSERT into articles (title, date, writer, innerText, `fullText`) VALUES (?,?,?,?,?)");
                $stmt->execute([$article->title, date('Y-m-d H:i'), $article->writer, $article->innerText, $article->fullText]);
                $article->id = $this->connection->lastInsertId();
                return $article;
            } catch (PDOException $e) {
                echo $e;
            } catch (Exception $ex)
            {
                echo $ex;
            }
        }
    }


    function update($article, $id)
    {
        if($this->ValidateUser()){
            try {
                $stmt = $this->connection->prepare("UPDATE articles SET title = ?, date=?, writer = ?, innerText = ?, `fullText` = ? WHERE id = ?");
                $stmt->execute([$article->title, date('Y-m-d H:i'), $article->writer, $article->innerText, $article->fullText, $id]);
                return $article;
            } catch (PDOException $e) {
                echo $e;
            }
        }
    }

    function delete($id)
    {
        if($this->ValidateUser()){
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
}
?>