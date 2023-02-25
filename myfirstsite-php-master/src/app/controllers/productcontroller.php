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
            // TODO: add logic to handle the file upload, keep ref in img db
            $this->product_service->insert($product);
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

    public function uploadImg()
    {
        try {
            $uploadDir = '../public/uploads/';

            if(array_key_exists('upload-picture', $_FILES)){
              $uploadFile = $uploadDir . basename($_FILES['upload-picture']['name']);
              move_uploaded_file($_FILES['upload-picture']['tmp_name'], $uploadFile);

              $this->respondFileWithCode(200, $uploadFile);
            } else {
              $this->respondWithError(500, "Possible file upload attack!\n");
            }
            
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function readFile()
    {
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json);
            $picturName = $data->pictureName;

            if(isset($picturName))
            {
                $this->respondWithCode(200, $this->extractSource($picturName));
            } else 
            {
                $this->respondWithError(500, "Problems empty picturename");
            }
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }
    }
}
?>