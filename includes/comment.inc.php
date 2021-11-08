<?php 
include("../classes/comment.class.php");

$post_id = $_POST["post_id"];
$user = $_POST["user"];
$comment = $_POST["comment"];

$comm = new Comment($comment, $post_id, $user);

if ($comm->result) {
    echo true;
} else {
    echo false;
}
