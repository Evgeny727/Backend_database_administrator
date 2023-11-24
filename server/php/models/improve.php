<?php

class Improve
{
    // properties
    private $id;
    private $type;
    private $client;

    // constructor
    public function __construct($id, $type, $client)
    {
        $this->id = $id;
        $this->type = $type;
        $this->client = $client;
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

    public function getClient()
    {
        return $this->client;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }
}

?>