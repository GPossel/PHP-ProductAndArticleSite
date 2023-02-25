<?php
namespace Models;

class Product {
    public $id;
    public $name;
    public $price;
    public $description;
    public $image;
    public $category_id;

    function setId($id)
    {
        $this->id = $id;
    }

    function getId() 
    {
        return $this->id;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function getName() 
    {
        return $this->name;
    }

    function setPrice($price)
    {
        $this->price = $price;
    }

    function getPrice() 
    {
        return $this->price;
    }

    function setDescription($description)
    {
        $this->description = $description;
    }

    function getDescription() 
    {
        return $this->description;
    }

    function setImage($image)
    {
        $this->image = $image;
    }

    function getImage() 
    {
        return $this->image;
    }

    function setCatergory($category_id)
    {
        $this->category_id = $category_id;
    }

    function getCatergory() 
    {
        return $this->category_id;
    }
}
