<?php

class Employee
{
    // properties
    private $id;
    private $last_name;
    private $name;
    private $position;

    // constructor
    public function __construct($id, $last_name, $name, $position)
    {
        $this->id = $id;
        $this->last_name = $last_name;
        $this->name = $name;
        $this->position = $position;
    }

    // methods
    public function getId()
    {
        return $this->id;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getFIO()
    {
        return $this->getLastName()." ".$this->getName();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function setFIO($last_name, $name)
    {
        $this->setLastName($last_name);
        $this->setName($name);
    }
}

?>