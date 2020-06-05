<?php


namespace App\graphql;


use App\image;
use App\Post;

use App\Service\PostService;
use App\Http\Controllers\Controller;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class PostGraphql extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
        $this->middleware('jwt');
    }

    /**
     * 查看详情
     *
     */
    public function index($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $page = $args->page;
        $posts = $this->postService->get($page);
        return $posts;
    }

    /**
     * 写
     *
     */
    public function write($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user_id = request()->user_id;

        $title = $args['title'];
        $content = $args['content'];
        $post = Post::create([
            'title' => $title,
            'content' => $content,
            'user_id' => $user_id,
        ]);
        if ($image = $args['image_url']) {
            image::create([
                'post_id' => $post->id,
                'image_url' => $image,
                'image_type' => "博客"
            ]);
        };
        $msg = '发布成功';
        return $msg;
    }

    /**
     * 删除
     *
     */
    public function delect($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user_id = request()->user_Id;
        $id = $args['post_id'];
        $post = Post::find($id);
        if ($post->user_id != $user_id) {
            throw new \Exception('抱歉，这是别人的');
        }
        $post->status = 1;
        $post->save();
        return '删除成功';
    }

    /**
     * 转发
     *
     *
     */
    public function forward($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user_id = request()->user_id;
        $id = $args['post_id'];
        $post = Post::find($id);
        if ($post->status == 1) {
            throw new \Exception('抱歉，该帖子已经删除');
        }
        Post::create([
            'title' => $post->title,
            'content' => $post->content,
            'user_id' => $user_id,
            'post_id' => $post->id,
        ]);
        return '转发成功';
    }

    /**
     * 点赞
     *
     */

    public function like($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user_id = request()->user_id;
        $post_id = $args['post_id'];
        $status = $args['status'];
        return $this->postService->like($user_id, $post_id, $status);
    }

    /**
     * 留言
     *
     */
    public function reply($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user_id = request()->user_id;
        $post_id = $args['post_id'];
        $reply = $args['reply'];

        return $this->postService->reply($user_id, $post_id, $reply);
    }

    /**
     * 点击查看留言详情
     *
     */
    public function details($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $post_id = $args['post_id'];
        $post = $this->postService->details($post_id);
        return $post;

    }

    /**
     * 回复留言
     *
     *
     *
     */
    public function replyToUser($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user_id = request()->user_id;
        $post_id = $args['post_id'];
        $reply_id = $args['reply_id'];
        $reply = $args['reply'];
        return $this->postService->Replied($post_id, $reply_id, $reply, $user_id);

    }
}
