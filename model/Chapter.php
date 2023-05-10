<?php

class Chapter{
    private $id;
    private $courseId;
    private $userId;
    private $title;
    private $description;
    private $cost;
    private $video;
    private $links;
    private $documentsPath;

    public function __construct($id, $courseId, $userId, $title, $description, $cost, $video, $links, $documentsPath)
    {
        $this->id = $id;
        $this->courseId = $courseId;
        $this->userId = $userId;
        $this->title = $title;
        $this->description = $description;
        $this->cost = $cost;
        $this->video = $video;
        $this->links = $links;
        $this->documentsPath = $documentsPath;
    }


    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getCourseId(){
        return $this->courseId;
    }
    public function setCourseId($courseId){
        $this->courseId = $courseId;
    }

    public function getUserId(){
        return $this->userId;
    }
    public function setUserId($userId){
        $this->userId = $userId;
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

    public function getCost(){
        return $this->cost;
    }
    public function setCost($cost){
        $this->cost = $cost;
    }

    public function getVideoPath(){
        return $this->video;
    }
    public function setVideoPath($video){
        $this->video = $video;
    }
    
    public function getLinks(){
        return $this->links;
    }
    public function setLinks($links){
        $this->links = $links;
    }

    public function getDocumentsPath(){
        return $this->documentsPath;
    }
    public function setDocumentsPath($documentsPath){
        $this->documentsPath = $documentsPath;
    }
}