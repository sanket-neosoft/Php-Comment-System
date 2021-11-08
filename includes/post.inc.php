<?php
include("../classes/post.class.php");

$image_name = $_FILES["image"]["name"];
$image_tmp = $_FILES["image"]["tmp_name"];
$extension = pathinfo($image_name, PATHINFO_EXTENSION);
$caption = $_POST["caption"];
$user = $_POST["user"];

$image = "post" . time() . "-" . rand() . "." . $extension;

if (move_uploaded_file($image_tmp, "../media/$image")) {
    $post = new Post($image, $caption, $user);
} else {
    $post->result["error"] = "Falied to upload image";
}

echo $post->result;