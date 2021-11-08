<?php
include("db.class.php");

class Login extends Connection
{
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

        $login = $this->connect()->prepare("SELECT * FROM `users` WHERE `username` = ? AND `password` = ?;");
        $login->execute(array($this->username, $this->password));

        if ($login->rowCount() > 0) {
            $this->result = true;
        } else {
            $this->result = false;
        }
        return $this->result;
    }
}
