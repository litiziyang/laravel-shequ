<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Post
 *
 * @property int                                                        $id
 * @property string                                                     $title     标题
 * @property string                                                     $content   内容
 * @property int                                                        $user_id   发帖人
 * @property int                                                        $like_num  点赞次数
 * @property int                                                        $reply_num 留言次数
 * @property int                                                        $post_id   帖子id
 * @property string                                                     $status    0:发表，1:已被删除
 * @property \Illuminate\Support\Carbon|null                            $created_at
 * @property \Illuminate\Support\Carbon|null                            $updated_at
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @method static Builder|Post whereContent($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereImageId($value)
 * @method static Builder|Post whereLikeNum($value)
 * @method static Builder|Post wherePostId($value)
 * @method static Builder|Post whereReplyNum($value)
 * @method static Builder|Post whereStatus($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @method static Builder|Post whereUserId($value)
 * @mixin \Eloquent
 * @property-read Collection|\App\image[]                               $images
 * @property-read int|null                                              $images_count
 * @property-read Post|null                                             $forward
 * @property-read Collection|\App\Like[]                                $like
 * @property-read int|null                                              $like_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reply[] $reply
 * @property-read int|null                                              $reply_count
 */
class Post extends Model
{
    //
    protected $fillable = [
        'title', 'content', 'user_id', 'like_num', 'reply_num', 'post_id', 'status'
    ];

    public function images()
    {
        return $this->hasMany(image::class, "post_id", "id");
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'post_id', 'id');
    }

    public function forward()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }

    public function reply()
    {
        return $this->hasMany(Reply::class, 'post_id', 'id');
    }

}
