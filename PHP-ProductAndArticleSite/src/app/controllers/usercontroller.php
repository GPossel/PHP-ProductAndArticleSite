<?php
namespace Controllers;

use Services\UserService;
use Exception;

class UserController extends Controller {

    private $user_service;

    function __construct()
    {
        $this->user_service = new UserService();
    }

    public function getTest() {
        $this->respond('Gentle test UserController');
    }

    public function login() {
        try {
            $login = $this->createObjectFromPostedJson("Models\Login");
            $this->respond($this->user_service->login($login->getUsername(), $login->getPassword()));
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function getOne($id) {
        try {
            $this->respond($this->user_service->getOne($id));
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function insert($user) {
        try {
            $this->respond($this->user_service->insert($user));        
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function delete($item) {
        try {
            $this->respond($this->user_service->delete($item));        
        } catch (Exception $e)
        {
            $this->respondWithError(500, $e->getMessage());
        }    
    }
}
?>