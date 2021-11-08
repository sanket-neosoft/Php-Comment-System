<?php
include("../classes/register.class.php");

$name = $_POST["name"];
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$age = $_POST["age"];

// register class object
$register = new Register($email, $password, $username, $name, $age);

// start session and load home page
if ($register->result) {
    session_start();
    $_SESSION["username"] = $username;
    echo true;
} else {
    echo false;
}
