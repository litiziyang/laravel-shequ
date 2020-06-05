<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\aunt
 *
 * @property int                             $id
 * @property string                          $type      1:开始，0:结束
 * @property string                          $datetimes 时间
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\aunt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\aunt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\aunt query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\aunt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\aunt whereDatetimes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\aunt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\aunt whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\aunt whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id 用户ID
 * @method static \Illuminate\Database\Eloquent\Builder|\App\aunt whereUserId($value)
 */
class aunt extends Model
{
    protected $fillable = [
        'type', 'datetimes', 'user_id'
    ];
}
