<?php
include("db.class.php");

class ChangePass extends Connection
{
    public function __construct($user,$old_pass, $new_pass)
    {
        $this->user = $user;
        $this->old_pass = $old_pass;
        $this->new_pass = $new_pass;

        $change = $this->connect()->prepare("SELECT `password` FROM users WHERE username = ?;");
        $change->execute(array($this->user));
        $dbpass = $change->fetch(PDO::FETCH_ASSOC);

        if ($dbpass["password"] === $this->old_pass) {
            $change_pass = $this->connect()->prepare("UPDATE users SET `password` = ? WHERE username = ?;");
            $change_pass->execute(array($this->new_pass, $this->user));
            $this->result = true;
        } else {
            $this->result = false;
        }
    }
}
