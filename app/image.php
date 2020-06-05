<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\image
 *
 * @property int                             $id
 * @property string                          $image_type 照片类型
 * @property int                             $image_url  照片链接
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\image query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\image whereImageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\image whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\image whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null                        $post_id    博客id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\image wherePostId($value)
 */
class image extends Model
{
    protected $fillable = [
        'image_type', 'image_url', 'post_id'
    ];
}
