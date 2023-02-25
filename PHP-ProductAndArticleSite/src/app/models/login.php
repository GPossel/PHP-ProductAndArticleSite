<?php 
namespace Models;

class Login 
{
    public $username;
    public $password;

    function getUsername()
    {
        return $this->username;
    }

    function getPassword()
    {
        return $this->password;
    }
}