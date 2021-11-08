<?php
include("../classes/change_pass.class.php");

$user = $_POST["user"];
$old_pass = $_POST["oldpass"];
$new_pass = $_POST["newpass"];

$change = new ChangePass($user, $old_pass, $new_pass);

echo $change->result;