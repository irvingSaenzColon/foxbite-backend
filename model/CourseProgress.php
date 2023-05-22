<?php
class CourseProgress{
    private $id;
    private $seen;
    private $seenAt;
    private $time;
    private $courseId;
    private $chapterId;
    private $userId;

    public function __construct($id, $seen, $seenAt, $time, $courseId, $chapterId, $userId)
    {
        $this->id = $id;
        $this->seen = $seen;
        $this->seenAt = $seenAt;
        $this->time = $time;
        $this->courseId = $courseId;
        $this->chapterId = $chapterId;
        $this->userId = $userId;
    }

    
    public function jsonSerialize(){
        return json_encode(get_object_vars($this), JSON_UNESCAPED_SLASHES);
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
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of seen
     */ 
    public function getSeen()
    {
        return $this->seen;
    }

    /**
     * Set the value of seen
     *
     * @return  self
     */ 
    public function setSeen($seen)
    {
        $this->seen = $seen;

        return $this;
    }

    /**
     * Get the value of seenAt
     */ 
    public function getSeenAt()
    {
        return $this->seenAt;
    }

    /**
     * Set the value of seenAt
     *
     * @return  self
     */ 
    public function setSeenAt($seenAt)
    {
        $this->seenAt = $seenAt;

        return $this;
    }

    /**
     * Get the value of time
     */ 
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */ 
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of courseId
     */ 
    public function getCourseId()
    {
        return $this->courseId;
    }

    /**
     * Set the value of courseId
     *
     * @return  self
     */ 
    public function setCourseId($courseId)
    {
        $this->courseId = $courseId;

        return $this;
    }

    /**
     * Get the value of chapterId
     */ 
    public function getChapterId()
    {
        return $this->chapterId;
    }

    /**
     * Set the value of chapterId
     *
     * @return  self
     */ 
    public function setChapterId($chapterId)
    {
        $this->chapterId = $chapterId;

        return $this;
    }
}