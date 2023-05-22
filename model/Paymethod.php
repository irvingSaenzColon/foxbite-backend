<?php
class Paymethod{
    private $id;
    private $number;
    private $expires;
    private $zipcode;
    private $type;
    private $owner;
    private $bank;
    private $belongs;

    public function __construct($id, $number, $expires, $zipcode, $type, $owner, $bank, $belongs)
    {
        $this->id = $id;
        $this->number = $number;
        $this->expires = $expires;
        $this->zipcode = $zipcode;
        $this->type = $type;
        $this->owner = $owner;
        $this->bank = $bank;
        $this->belongs = $belongs;
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
     * Get the value of number
     */ 
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of zipcode
     */ 
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set the value of zipcode
     *
     * @return  self
     */ 
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

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
     * Get the value of bank
     */ 
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Set the value of bank
     *
     * @return  self
     */ 
    public function setBank($bank)
    {
        $this->bank = $bank;

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
     * Get the value of expires
     */ 
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * Set the value of expires
     *
     * @return  self
     */ 
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }
}