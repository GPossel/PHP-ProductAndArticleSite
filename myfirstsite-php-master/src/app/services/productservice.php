<?php
namespace Services;

use Repositories\ProductRepository;

class ProductService {

    private $product_repository;

    function __construct()
    {
        $this->product_repository = new ProductRepository();
    }

    public function getTest() {
        return $this->product_repository->getTest();
    }
    
    public function getAll($offset = null, $limit = null) {
        return $this->product_repository->getAll($offset, $limit);
    }

    public function getOne($id) {
        return $this->product_repository->getOne($id);
    }

    public function insert($item) {       
        return $this->product_repository->insert($item);        
    }

    public function update($item, $id) {       
        return $this->product_repository->update($item, $id);        
    }

    public function delete($item) {       
        return $this->product_repository->delete($item);        
    }
}
?>