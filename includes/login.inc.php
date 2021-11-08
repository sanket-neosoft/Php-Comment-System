<?php
include("../classes/login.class.php");

$username = $_POST["username"];
$password = $_POST["password"];

// login class object
$login = new Login($username, $password);

// start session and load to home page
if ($login->result) {
    session_start();
    $_SESSION["username"] = $username;
} 
echo $login->result;
