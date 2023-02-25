<?php
namespace Repositories;

use Exception;
use PDO;
use PDOException;

class CategoryRepository extends Repository
{
    function getOne($id)
    {
        try {
            $query = 'SELECT name, id FROM category WHERE id = :id';

            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Category');
            
            $result = $stmt->fetchAll();
            return $result;

        } catch (PDOException $e)
        {
            return $e;
        } catch (Exception $ex)
        {
            return $ex;
        }
    }

    function getAll($limit, $offset)
    {
        try {
            $query = 'SELECT * FROM category';

            if(isset($limit) && isset($offset))
            {
                $query .= 'LIMIT :limit OFFSET :offset';
            }

            $stmt = $this->connection->prepare($query);

            if(isset($limit) && isset($offset))
            {
                $stmt->bindParam(':limit', $limit);
                $stmt->bindParam(':offset', $offset);
            }

            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Category');

            $categoriesArray = $stmt->fetchAll();
            return $categoriesArray;
        } catch (PDOException $e)
        {
            return $e;
        }  catch (Exception $ex)
        {
            return $ex;
        }
    }
}
?>