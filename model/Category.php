<?php
class Category{
    private $id;
    private $title;
    private $description;
    private $cover;
    private $extension;
    private $createdBy;

    public function __construct($id, $title, $description, $cover, $extension, $createdBy)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->cover = $cover;
        $this->extension = $extension;
        $this->createdBy = $createdBy;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->$id = $id;
    }

    public function getTitle(){
        return $this->title;
    }
    public function setTitle($title){
        $this->title = $title;
    }

    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description = $description;
    }

    public function getCover(){
        return $this->cover;
    }
    public function setCover($cover){
        $this->cover = $cover;
    }

    public function getExtension(){
        return $this->extension;
    }
    public function setExtension($extension){
        $this->extension = $extension;
    }

    public function getCreatedBy(){
        return  $this->createdBy;
    }
    public function setCreatedBy($createdBy){
        $this->createdBy = $createdBy;
    }

    public function jsonSerialize(){
        return json_encode(get_object_vars($this), JSON_UNESCAPED_SLASHES);
    }
}