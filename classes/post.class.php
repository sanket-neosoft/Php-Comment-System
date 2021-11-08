<?php
include("db.class.php");

class Post extends Connection
{
    public function __construct($image, $caption, $user)
    {
        $this->image = $image;
        $this->caption = $caption;
        $this->user = $user;

        $post = $this->connect()->prepare("INSERT INTO post(`image`, `caption`, `user`) VALUES(?, ?, ?);");

        if ($post->execute(array($this->image, $this->caption, $this->user))) {
            $this->result = true;
        } else {
            $this->result = false;
        }
        return $this->result;
    }
}
