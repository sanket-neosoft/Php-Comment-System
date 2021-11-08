<?php
include("classes/login.class.php");

$conn = new Login('sanket_kumbhare', "asdfgfdsa");

print_r($conn->result);