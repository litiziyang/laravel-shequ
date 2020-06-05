<?php


namespace App\graphql;

use App\Http\Resources\BaseResource;
use App\Http\Service\UserService;
use App\Http\Controllers\Controller;
use App\Like;
use App\User;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Http\Request;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;


class UserControlls extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('jwt');
    }

    /**
     * 获取个人详细信息
     *
     *
     */
    public function index($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user_id = \request()->user_id;
        $user = $this->userService->getInfo($user_id);
        return $user;
    }

    /**
     * 获取验证码
     *
     *
     */
    public function commit($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $phone = $args['phone'];
        if (\Cache::has($phone)) {
            throw new \Exception('60秒内只能获取一次');
        }
        \Cache::put($phone, rand(1000, 9999), 60);
        return \Cache::get($phone);
    }

    /**
     * 携带验证码提交
     *
     *
     */
    public function verify($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $phone = $args['phone'];
        $code = $args['code'];
        if (\Cache::get($phone) == $code) {
            \Cache::forget($phone);
            $user = User::firstOrCreate([
                'phone' => $phone,
                'name' => '用户' . $phone,
            ]);
            $token = $user->getToken();
            return $token;
        } else {
            throw  new \Exception('验证码错误');
        }
    }

    /**
     * 查看自己点赞的帖子
     *
     *
     */
    public function looklike($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user_id = \request()->user_id;
        $user = $this->userService->find($user_id);
        return $user;
    }

    /**
     * 查看自己的帖子
     *
     *
     */

    public function lookpost($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user_id = \request()->user_id;
        return $this->userService->lookpost($user_id);

    }

    /**
     * 查看自己的留言
     *
     *
     *
     */
    public function lookreply($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user_id = \request()->user_id;
        return $this->userService->find($user_id);
    }


}
