<?php
include("db.class.php");

class Comment extends Connection
{
    public function __construct($comment, $post_id, $user)
    {
        $this->comment = $comment;
        $this->post_id = $post_id;
        $this->user = $user;

        $comment = $this->connect()->prepare("INSERT INTO comments(`comment`, `user`, `post_id`) VALUES(?, ?, ?);");
        if($comment->execute(array($this->comment, $this->user, $this->post_id))) {
            $this->result = true;
        } else {
            $this->result = false;
        }
        return $this->result;
    }
}
