<?php
namespace Models;

class User {
    public $id;
    public $username;
    public $email;
    public $password;
    
    function setId($id)
    {
        $this->id = $id;
    }

    function getId() 
    {
        return $this->id;
    }

    function setUsername($username)
    {
        $this->username = $username;
    }

    function getUsername() 
    {
        return $this->username;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function getEmail() 
    {
        return $this->email;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    function getPassword() 
    {
        return $this->password;
    }
}
?>