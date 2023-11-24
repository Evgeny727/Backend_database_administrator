<?php

class Component_type
{
    // properties
    private $id;
    private $type;

    // constructor
    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }

    // methods
    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
}

?>