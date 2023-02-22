<?php
namespace Controllers;

use Services\ProductService;
use Exception;

class ProductController extends Controller {

    private $product_service;

    function __construct() {
        $this->product_service = new ProductService();
    }
    
    public function getTest() {
        try {
            $this->respond(phpinfo());
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }
    }
    
    public function getAll($offset = null, $limit = null) {
        try {
            $this->respond($this->product_service->getAll($offset, $limit));
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function getOne($id) {
        try {
            $this->respond($this->product_service->getOne($id));
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function post() {
        try {
            $product = $this->createObjectFromPostedJson("Models\Product");
            $this->respond($this->product_service->insert($product));
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function update($id) {
        try {
            $product = $this->createObjectFromPostedJson("Models\Product");
            $this->respond($this->product_service->update($product, $id));        
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }
    }


    public function delete($item) {
        try {
            $this->respond($this->product_service->delete($item));
        } catch (Exception $e)
        {   
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function uploadImg($img)
    {
        try {
            $this->respond("Upload Img succes!");
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }

    }
}
?>