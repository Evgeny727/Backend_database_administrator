<?php

class Client
{
    // properties
    private $id;
    private $email;
    private $last_name;
    private $name;
    private $password;
    private $birth_date;
    private $account_number;

    // constructor
    public function __construct($id, $email, $last_name, $name, $password, $birth_date, $account_number)
    {
        $this->id = $id;
        $this->email = $email;
        $this->last_name = $last_name;
        $this->name = $name;
        $this->password = $password;
        $this->birth_date = $birth_date;
        $this->account_number = $account_number;
    }

    // methods
    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getBirthDate()
    {
        return $this->birth_date;
    }

    public function getAccountNumber()
    {
        return $this->account_number;
    }

    public function getFIO()
    {
        return $this->last_name." ".$this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setBirthDate($birth_date)
    {
        $this->birth_date = $birth_date;
    }

    public function setAccountNumber($account_number)
    {
        $this->account_number = $account_number;
    }

    public function setFIO($last_name, $name)
    {
        $this->setLastName($last_name);
        $this->setName($name);
    }
}

?>