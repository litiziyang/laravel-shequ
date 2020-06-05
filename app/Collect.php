<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Collect
 *
 * @property int                             $id
 * @property int                             $user_id 用户id
 * @property int                             $post_id 帖子id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Collect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Collect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Collect query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Collect whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Collect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Collect wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Collect whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Collect whereUserId($value)
 * @mixin \Eloquent
 */
class Collect extends Model
{
    //
}
