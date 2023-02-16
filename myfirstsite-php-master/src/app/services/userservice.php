<?php
namespace Services;

use Repositories\UserRepository;

class UserService {

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function login($username, $password) {
        return $this->repository->login($username, $password);
    }

    public function getOne($id) {
        return $this->repository->getOne($id);
    }

    public function insert($user) {       
        return $this->repository->insert($user);        
    }

    public function update($user, $id) {       
        return $this->repository->update($user, $id);        
    }

    public function delete($user) {       
        return $this->repository->delete($user);        
    }
}
?>