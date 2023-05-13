<?php

class Comment{
    private int $id;
    private int $belongs;
    private int $by;
    private string $comment;
    private string $type;

    public function __construct($id, $belongs, $by, $comment, $type)
    {
        $this->id = $id;
        $this->belongs = $belongs;
        $this->by = $by;
        $this->comment = $comment;
        $this->type = $type;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getBelongs(){
        return $this->belongs;
    }
    public function setBelongs($belongs){
        $this->belongs = $belongs;
    }

    public function getBy(){
        return $this->by;
    }
    public function setBy($by){
        $this->by = $by;
    }

    public function getComment(){
        return $this->comment;
    }
    public function setComment($comment){
        $this->comment = $comment;
    }

    public function getType(){
        return $this->type;
    }
    public function setType($type){
        $this->type = $type;
    }
}