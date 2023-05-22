<?php

class Chat{
    private $id;
    private $sender;
    private $receiver;
    private $content;

    public function __construct($id, $sender, $receiver, $content)
    {
        $this->id = $id;
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->content = $content;
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
     * Get the value of sender
     */ 
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set the value of sender
     *
     * @return  self
     */ 
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get the value of receiver
     */ 
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set the value of receiver
     *
     * @return  self
     */ 
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
}