<?php
namespace Models;

class Article {
    public $id;
    public $title;
    public $date;
    public $writer;
    public $innerText;
    public $fullText;

    function setId($id)
    {
        $this->id = $id;
    }

    function getId() 
    {
        return $this->id;
    }

    function setTitle($title)
    {
        $this->title = $title;
    }

    function getTitle() 
    {
        return $this->title;
    }

    function setDate($date)
    {
        $this->date = $date;
    }

    function getDate() 
    {
        return $this->date;
    }

    function setWriter($writer)
    {
        $this->writer = $writer;
    }

    function getWriter() 
    {
        return $this->writer;
    }

    function setInnerText($innerText)
    {
        $this->innerText = $innerText;
    }

    function getInnerText() 
    {
        return $this->innerText;
    }

    function setFullText($fullText)
    {
        $this->fullText = $fullText;
    }

    function getFullText() 
    {
        return $this->fullText;
    }
}
?>