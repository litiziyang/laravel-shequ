<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;

/**
 * App\User
 *
 * @property int                                                                                                            $id
 * @property string                                                                                                         $name     昵称
 * @property int                                                                                                            $phone    电话号码
 * @property string                                                                                                         $birthday 生日
 * @property int                                                                                                            $height   身高
 * @property string                                                                                                         $status   状态0:经期，1:备孕，2:怀孕，3:宝妈
 * @property int                                                                                                            $cycle    周期
 * @property int                                                                                                            $duration 持续时间
 * @property string                                                                                                         $address  地址
 * @property int                                                                                                            $godcoin  金币
 * @property \Illuminate\Support\Carbon|null                                                                                $created_at
 * @property \Illuminate\Support\Carbon|null                                                                                $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null                                                                                                  $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCycle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGodcoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[]                                                      $post
 * @property-read int|null                                                                                                  $post_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Like[]                                                      $like
 * @property-read int|null                                                                                                  $like_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reply[] $reply
 * @property-read int|null $reply_count
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'birthday', 'height', 'duration', 'address', 'godcoin', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function post()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function like()
    {
        return $this->belongsToMany(Post::class,'likes');
    }

    public function reply(){
        return $this->hasMany(Reply::class,'user_id','id');
    }



    public function getToken()
    {
        $token = (new Builder())
            ->issuedBy('https://www.leisite.com')
            ->permittedFor('https://www.leisite.com')
            ->IssuedAt(time())
            ->expiresAt(time() + config('app.jwt.time'))
            ->withClaim('id', $this->id)
            ->getToken(new Sha256(), new Key(config('app.jwt.secret')));
        return (string)$token;

    }
}
