<?php


namespace App\Service;


interface PostService
{
    public function get($page);

    public function like($user_id, $post_id, $status);

    public function reply($user_id, $post_id,$reply);

    public function details($pos_id);

    public function Replied($post_id, $reply_id, $reply, $user_id);
}
