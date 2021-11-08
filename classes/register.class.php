<?php
include("db.class.php");

class Register extends Connection
{
    public function __construct($email, $password, $username, $name, $age)
    {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->name = $name;
        $this->age = $age;

        $register = $this->connect()->prepare("INSERT INTO users(`name`, `email`, `username`,`age`,`password`) VALUES(?, ?, ?, ?, ?);");


        if ($register->execute(array($this->name, $this->email, $this->username, $this->age, $this->password))) {
            $this->result = true;
        } else {
            $this->result = false;
        }

        return $this->result;
    }
}
