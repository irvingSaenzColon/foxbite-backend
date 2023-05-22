<?php
class Review{
    private $id;
    private $comment;
    private $score;
    private $belongs;
    private $by;

    public function __construct($id, $comment, $score, $belongs, $by)
    {
        $this->id = $id;
        $this->comment = $comment;
        $this->score = $score;
        $this->belongs = $belongs;
        $this->by = $by;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of score
     */ 
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set the value of score
     *
     * @return  self
     */ 
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get the value of belongs
     */ 
    public function getBelongs()
    {
        return $this->belongs;
    }

    /**
     * Set the value of belongs
     *
     * @return  self
     */ 
    public function setBelongs($belongs)
    {
        $this->belongs = $belongs;

        return $this;
    }

    /**
     * Get the value of by
     */ 
    public function getBy()
    {
        return $this->by;
    }

    /**
     * Set the value of by
     *
     * @return  self
     */ 
    public function setBy($by)
    {
        $this->by = $by;

        return $this;
    }
}