<?php
namespace Services;

use Exception;
use Repositories\CategoryRepository;

class CategoryService {

    private $categoryservice;

    function __construct()
    {
        $this->categoryservice = new CategoryRepository();
    }

    function getOne($id)
    {
        try {
            $category = $this->categoryservice->getOne($id);
            return $category;
        } catch(Exception $e)
        {
            return $e;
        }
    }

    function getAll($limit, $offset)
    {
        try {
            $categories = $this->categoryservice->getAll($limit, $offset);
            return $categories;
        } catch (Exception $e)
        {
            return $e;
        }
    }
}
?>