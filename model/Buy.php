<?php
class Buy{
    private $id;
    private $detailId;
    private $paymethodId;
    private $total;
    private $owner;
    private $courseId;
    private $chapterId;
    private $detailCost;

    public function __construct($id, $detailId, $paymethodId, $owner, $courseId, $chapterId ,$total, $detailCost)
    {
        $this->id = $id;
        $this->detailId = $detailId;
        $this->paymethodId = $paymethodId;
        $this->owner = $owner;
        $this->courseId = $courseId;
        $this->chapterId = $chapterId;
        $this->total = $total;
        $this->detailCost = $detailCost; 
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
     * Get the value of detailId
     */ 
    public function getDetailId()
    {
        return $this->detailId;
    }

    /**
     * Set the value of detailId
     *
     * @return  self
     */ 
    public function setDetailId($detailId)
    {
        $this->detailId = $detailId;

        return $this;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     *
     * @return  self
     */ 
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get the value of owner
     */ 
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the value of owner
     *
     * @return  self
     */ 
    public function setOwner($owner)
    {
        $this->owner = $owner;

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

    /**
     * Get the value of detailCost
     */ 
    public function getDetailCost()
    {
        return $this->detailCost;
    }

    /**
     * Set the value of detailCost
     *
     * @return  self
     */ 
    public function setDetailCost($detailCost)
    {
        $this->detailCost = $detailCost;

        return $this;
    }

    /**
     * Get the value of paymethodId
     */ 
    public function getPaymethodId()
    {
        return $this->paymethodId;
    }

    /**
     * Set the value of paymethodId
     *
     * @return  self
     */ 
    public function setPaymethodId($paymethodId)
    {
        $this->paymethodId = $paymethodId;

        return $this;
    }
}