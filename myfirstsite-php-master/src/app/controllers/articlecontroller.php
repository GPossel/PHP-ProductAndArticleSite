<?php
namespace Controllers;

use Services\ArticleService;
use Exception;

class ArticleController extends Controller {

    private $article_service;

    function __construct()
    {
        $this->article_service = new ArticleService();
    }
    
    public function getTest() {
        echo 'Gentle-ArticleController';
    }

    public function get() {
        try {
            $this->respond($this->article_service->getTest());
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function getAll($offset = null, $limit = null) {
        try {
            $this->respond($this->article_service->getAll($offset, $limit));
        } catch (Exception $e) {
            $this->respondWithError($e->getCode(), $e->getMessage());
        }
    }

    public function getOne($id) {
        try {
            $this->respond($this->article_service->getOne($id));
        } catch (Exception $e)
        {
            $this->respondWithError($e->getCode(), $e->getMessage());
        } 
    }

    public function insert() {    
        try {
            $article = $this->createObjectFromPostedJson("Models\Article");
            $this->respond($this->article_service->insert($article));
        } catch (Exception $e)
        {
            $this->respondWithError($e->getCode(), $e->getMessage());
        }
    }

    public function update($id) {
        try {
            $article = $this->createObjectFromPostedJson("Models\Article");
            $this->respond($this->article_service->update($article, $id));
        } catch (Exception $e)
        {
            $this->respondWithError($e->getCode(), $e->getMessage());
        }   
    }

    public function delete($id) {
        try {
            $this->respond($this->article_service->delete($id));
        } catch (Exception $e)
        {
            $this->respondWithError($e->getCode(), $e->getMessage());
        }  
    }
}
?>