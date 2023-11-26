<?php

class Warranty
{
    // properties
    private $id;
    private $id_order;
    private $valid_until;

    // constructor
    public function __construct($id, $id_order, $valid_until)
    {
        $this->id = $id;
        $this->id_order = $id_order;
        $this->valid_until = $valid_until;
    }

    // methods
    public function getId()
    {
        return $this->id;
    }

    public function getIdOrder()
    {
        return $this->id_order;
    }

    public function getValidUntil()
    {
        return $this->valid_until;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdOrder($id_order)
    {
        $this->id_order = $id_order;
    }

    public function setIdValidUntil($valid_until)
    {
        $this->valid_until = $valid_until;
    }
}

?>