<?php

class Status
{
    // properties
    private $id;
    private $status;

    // constructor
    public function __construct($id, $status)
    {
        $this->id = $id;
        $this->status = $status;
    }

    // methods
    public function getId()
    {
        return $this->id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}

?>