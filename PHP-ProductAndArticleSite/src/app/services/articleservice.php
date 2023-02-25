<?php
namespace Services;

use Repositories\ArticleRepository;

class ArticleService {

    private $repository;

    function __construct()
    {
        $this->repository = new ArticleRepository();
    }

    public function getTest() {
        return $this->repository->getTest();
    }

    public function getAll($offset = null, $limit = null) {
        return $this->repository->getAll($offset, $limit);
    }

    public function getOne($id) {
        return $this->repository->getOne($id);
    }

    public function insert($article) {       
        return $this->repository->insert($article);
    }

    public function update($item, $id) {       
        return $this->repository->update($item, $id);
    }

    public function delete($item) {       
        return $this->repository->delete($item);
    }
}
?>