<?php

class Order
{
    // properties
    private $id;
    private $client;
    private $employee;
    private $status;
    private $price;

    // constructor
    public function __construct($id, $client, $employee, $status, $price)
    {
        $this->id = $id;
        $this->client = $client;
        $this->employee = $employee;
        $this->status = $status;
        $this->price = $price;
    }

    // methods
    public function getId()
    {
        return $this->id;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getEmployee()
    {
        return $this->employee;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }
}

?>