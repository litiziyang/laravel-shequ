<?php


namespace App\Service\ServiceImp;


use App\Like;
use App\Post;
use App\Reply;
use App\Service\PostService;


class PostServiceImp implements PostService
{
    protected $post;


    public function __construct(Post $post)
    {
        $this->post = $post->query();

    }

    public function get($page)
    {
        $page = 10 * $page;
        $posts = $this->post
            ->orderBy('created_at', 'desc')
            ->where('status', 0)
            ->offset($page)
            ->limit(10)->get();
        return $posts;
    }

    public function like($user_id, $post_id, $status)
    {
        $like = Like::firstOrCreate([
            'user_id' => $user_id,
            'post_id' => $post_id
        ]);
        $like->status = $status;
        $like->save();
        if ($status == 1) {
            return '取消点赞成功';
        }
        if ($status == 0) {
            return '点赞成功';
        }
        $post = $this->post->find($post_id);
        $post->like_num += 1;
        $post->save;
    }

    public function reply($user_id, $post_id, $reply)
    {
        Reply::firstOrCreate([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'reply' => $reply
        ]);
        $post=$this->post->findOrFail($post_id);
        $post->reply_num+=1;
        $post->save();
        return '留言成功';
    }

    public function details($pos_id)
    {
      return  $this->post->findOrFail($pos_id);
    }

    public function Replied($post_id, $reply_id, $reply, $user_id)
    {
       Reply::firstOrCreate([
           'user_id'=>$user_id,
           'reply'=>$reply,
           'post_id'=>$post_id,
           'reply_id'=>$reply_id
       ]);

       return '留言成功';
    }
}
