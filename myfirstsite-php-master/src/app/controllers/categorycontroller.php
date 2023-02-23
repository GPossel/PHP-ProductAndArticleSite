<?php 
namespace Controllers;

use Exception;
use Services\CategoryService;

class CategoryController extends Controller {

    private $categoryservice;

    function __construct()
    {
        $this->categoryservice = new CategoryService();
    }
    
    function getOne($id)
    {
        try {
            $result = $this->categoryservice->getOne($id);
            return $this->respond($this->categoryservice->getOne($id));
        } catch (Exception $e) {
            return $this->respondWithCode(500, $e);
        }
    }

    function getAll($limit = null, $offset = null)
    {
        try {
            $result = $this->categoryservice->getAll($limit, $offset);
            return $this->respond($this->categoryservice->getAll($limit, $offset));
        } catch (Exception $e) {
            return $this->respondWithCode(500, $e);
        }
    }
}
?>