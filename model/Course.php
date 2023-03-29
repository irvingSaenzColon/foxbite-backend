<?php

class Course{
    private $id;
    private $title;
    private $description;
    private $price;
    private $chapters;
    private $cover;
    private $coverExtension;
    private $visible;
    private $createdAt;
    private $updatedAt;
    private $createdBy;

    public function __construct($id, $title, $description, $price, $chapters, $cover, $coverExtension, $visible, $createdAt, $updatedAt, $createdBy){
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->chapters = $chapters;
        $this->cover = $cover;
        $this->coverExtension = $coverExtension;
        $this->visible = $visible;
        $this->updatedAt = $updatedAt;
        $this->createdAt = $createdAt;
        $this->createdBy = $createdBy;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
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

    public function getPrice(){
        return $this->price;
    }
    public function setPrice($price){
        $this->price = $price;
    }

    public function getChapters(){
        return $this->chapters;
    }
    public function setChapters($chapters){
        $this->chapters = $chapters;
    }

    public function getCover(){
        return $this->cover;
    }
    public function setCover($cover){
        $this->cover = $cover;
    }

    public function getCoverExtension(){
        return $this->coverExtension;
    }
    public function setCoverExtension($coverExension){
        $this->coverExtension = $coverExension;
    }

    public function getVisible(){
        return $this->visible;
    }
    public function setVisible($visible){
        $this->visible = $visible;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }
    public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(){
        return $this->updatedAt;
    }
    public function setUpdatedAt($updatedAt){
        $this->updatedAt = $updatedAt;
    }

    public function getCraetedBy(){
        return $this->createdBy;
    }
    public function setCreatedBy($createdBy){
        $this->createdBy = $createdBy;
    }


    public function jsonSerialize(){
        return json_encode(get_object_vars($this), JSON_UNESCAPED_SLASHES);
    }
}