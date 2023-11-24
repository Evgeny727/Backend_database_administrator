<?php

class Position
{
    // properties
    private $id;
    private $position;

    // constructor
    public function __construct($id, $position)
    {
        $this->id = $id;
        $this->position = $position;
    }

    // methods
    public function getId()
    {
        return $this->id;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }
}

?>