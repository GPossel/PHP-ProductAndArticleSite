<?php
namespace Services;

use Repositories\ArticleRepository;

class ArticleService {

    private $repository;

    function __construct()
    {
        $this->repository = new ArticleRepository();
    }

    public function getAll($offset = NULL, $limit = NULL) {
        return $this->repository->getAll($offset, $limit);
    }

    public function getOne($id) {
        return $this->repository->getOne($id);
    }

    public function insert() {       
        $json = file_get_contents('php://input');
        $item = json_decode($json);
        return $this->repository->insert($item);        
    }

    public function update($item, $id) {       
        return $this->repository->update($item, $id);        
    }

    public function delete($item) {       
        return $this->repository->delete($item);        
    }
}

?>